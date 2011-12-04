<?php
/**
 * The ForcedPasswdChange object
 *
 * @package forcedpasswdchange
 */
class FPC {

	/**
     * Constructs the object
     *
     * @param modX &$modx A reference to the modX object
     * @param array $config An array of configuration options
     */
    function __construct(modX &$modx, array $config=array()) {
		$this->modx =& $modx;

		$namespace = $this->modx->getObject('modNamespace', 'forcedpasswdchange');

		$basePath = $namespace->get('path');
		$assetsUrl = $this->modx->getOption('assets_url').'components/forcedpasswdchange/';
		
		$this->config = array_merge(array(
			'basePath' => $basePath,
			'corePath' => $basePath,
			'modelPath' => $basePath.'model/',
			'processorsPath' => $basePath.'processors/',
			'chunksPath' => $basePath.'elements/chunks/',
			'jsUrl' => $assetsUrl.'js/',
			'cssUrl' => $assetsUrl.'css/',
			'assetsUrl' => $assetsUrl,
			'connectorUrl' => $assetsUrl.'connector.php',
		), $config);

		$this->modx->addPackage('forcedpasswdchange', $this->config['modelPath']);
		$this->modx->lexicon->load('forcedpasswdchange:default');
	}
}

?>