<?php
/**
 * ForcePasswdChange
 * Will force a user to change their password at login the first time
 *
 * @author Bert Oost at OostDesign.nl <bert@oostdesign.com>
 */
if($modx->context->get('key') != 'mgr') { return ''; }
$fpc = $modx->getService('forcedpasswdchange', 'FPC', $modx->getOption('forcedpasswdchange.core_path', null, $modx->getOption('core_path').'components/forcedpasswdchange/').'model/forcedpasswdchange/', array());
if (!($fpc instanceof FPC)) return '';

$eventName = $modx->event->name;
switch($eventName) {
    case 'OnManagerPageBeforeRender':
        $user =& $modx->user;
        if(empty($user) || !is_object($user)) { return ''; }
        
        $pwdch = $modx->getObject('forcedPasswdChange', array('user' => $user->get('id')));
        if(empty($pwdch) || !is_object($pwdch) || (is_object($pwdch) && $pwdch->get('changed') === true)) { return ''; }
        
        $modx->controller->addLexiconTopic('forcedpasswdchange:default');
        $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/forcedpasswdchange.js');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">
        Ext.onReady(function() {
            ForcedPasswdChange.config = '.$modx->toJSON($fpc->config).';
            ForcedPasswdChange.config.connector_url = "'.$fpc->config['connectorUrl'].'";
        });
        </script>');
        $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/widgets/forcedpasswdchange.window.js');
    break;
    
    case 'OnUserFormPrerender':
        $modx->controller->addLexiconTopic('forcedpasswdchange:default');
        $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/forcedpasswdchange.js');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">
        Ext.onReady(function() {
            ForcedPasswdChange.curruser = '.$modx->user->get('id').';
        });
        </script>');
        $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/widgets/userform.mod.js');
    break;
    
    case 'OnUserFormSave':
        if(isset($user) && is_object($user)) {
            $pwdch = $modx->getObject('forcedPasswdChange', array('user' => $user->get('id')));
            if(empty($pwdch) || !is_object($pwdch)) {
                $pwdch = $modx->newObject('forcedPasswdChange');
                $pwdch->set('user', $user->get('id'));
            }
            $force = $modx->request->getParameters('forcepwdchange', 'POST');
            $pwdch->set('changed', (empty($force)) ? true : false);
            $pwdch->save();
        }
    break;
}