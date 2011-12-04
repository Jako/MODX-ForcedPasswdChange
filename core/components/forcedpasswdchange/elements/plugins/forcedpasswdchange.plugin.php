<?php
/**
 * ForcePasswdChange
 * Will force a user to change their password at login the first time
 *
 * @author Bert Oost at OostDesign.nl <bertoost85@gmail.com>
 */

if($modx->context->get('key') != 'mgr') { return ''; }

$fpc = $modx->getService('forcedpasswdchange','FPC',$modx->getOption('forcedpasswdchange.core_path',null,$modx->getOption('core_path').'components/forcedpasswdchange/').'model/forcedpasswdchange/',$scriptProperties);
if (!($fpc instanceof FPC)) return '';

$eventName = $modx->event->name;
switch($eventName) {
  case 'OnManagerPageInit':
    $user =& $modx->user;
    if(empty($user) || !is_object($user)) { return ''; }
    
    $pwdch = $modx->getObject('forcedPasswdChange', array('user' => $user->get('id')));
    if(empty($pwdch) || !is_object($pwdch) || (is_object($pwdch) && $pwdch->get('changed') === true)) { return ''; }
    
    $modx->lexicon->load('forcedpasswdchange:default');
    $lexicons = $modx->lexicon->fetch('fpc');
    
    $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/forcedpasswdchange.js');
    $modx->regClientStartupHTMLBlock('<script type="text/javascript">
    Ext.onReady(function() {
	ForcedPasswdChange.config = '.$modx->toJSON($fpc->config).';
	ForcedPasswdChange.config.connector_url = "'.$fpc->config['connectorUrl'].'";
	ForcedPasswdChange.lang = '.$modx->toJSON($lexicons).';
    });
    </script>');
    $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/widgets/forcedpasswdchange.window.js');
  break;
  
  case 'OnUserFormRender':
    $modx->lexicon->load('forcedpasswdchange:default');
    $lexicons = $modx->lexicon->fetch('fpc');
    
    $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/forcedpasswdchange.js');
    $modx->regClientStartupHTMLBlock('<script type="text/javascript">
    Ext.onReady(function() {
	ForcedPasswdChange.curruser = '.$modx->user->get('id').';
	ForcedPasswdChange.lang = '.$modx->toJSON($lexicons).';
    });
    </script>');
    $modx->regClientStartupScript($fpc->config['jsUrl'].'mgr/widgets/userform.mod.js');
  break;
  
  case 'OnUserSave':
    if(isset($user) && is_object($user)) {
    
      $pwdch = $modx->getObject('forcedPasswdChange', array('user' => $user->get('id')));
      if(empty($pwdch) || !is_object($pwdch)) {
        $pwdch = $modx->newObject('forcedPasswdChange');
	$pwdch->set('user', $user->get('id'));
      }
      
      $force = $modx->request->getParameters('forcepwdchange', 'POST');
      if(empty($force)) {
        $pwdch->set('changed', true);
      } else {
	$pwdch->set('changed', false);
      }
      
      $pwdch->save();
    }
  break;
}

?>