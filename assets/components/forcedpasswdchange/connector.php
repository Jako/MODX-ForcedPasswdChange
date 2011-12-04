<?php
/**
 * ForcedPasswdChange Connector
 *
 * @package forcedpasswdchange
 */

require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$namespace = $modx->getObject('modNamespace', 'forcedpasswdchange');
$corePath = $namespace->get('path');
require_once $corePath.'model/forcedpasswdchange/fpc.class.php';
$modx->forcedpasswdchange = new FPC($modx);
$modx->lexicon->load('forcedpasswdchange:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->forcedpasswdchange->config, $corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));

?>