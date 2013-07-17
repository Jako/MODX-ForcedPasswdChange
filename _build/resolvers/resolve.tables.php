<?php

$modx =& $object->xpdo;

switch($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
		$modelPath = $modx->getOption('forcedpasswdchange.core_path', null, $modx->getOption('core_path').'components/forcedpasswdchange/').'model/';
		$modx->addPackage('forcedpasswdchange', $modelPath);
		
		$manager = $modx->getManager();

		$oldLogLevel = $modx->getLogLevel();
        $modx->setLogLevel(0);

        $manager->createObjectContainer('forcedPasswdChange');

        $modx->setLogLevel($oldLogLevel);
	break;
}

return true;

?>