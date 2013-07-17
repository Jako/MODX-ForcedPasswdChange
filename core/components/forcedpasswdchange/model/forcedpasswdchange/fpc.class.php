<?php

class FPC
{
	public $modx;
    public $config = array();

    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;

		$basePath = $this->modx->getOption('forcedpasswdchange.core_path',$config,$this->modx->getOption('core_path').'components/forcedpasswdchange/');
        $assetsUrl = $this->modx->getOption('forcedpasswdchange.assets_url',$config,$this->modx->getOption('assets_url').'components/forcedpasswdchange/');

        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'templatesPath' => $basePath.'templates/',
            'chunksPath' => $basePath.'elements/chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
        ),$config);

		$this->modx->addPackage('forcedpasswdchange', $this->config['modelPath']);
	}
}

?>