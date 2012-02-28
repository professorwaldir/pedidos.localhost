<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoloader() {
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader -> registerNameSpace("TC");
		return $autoloader;
	}
	
	
	protected function _initPlugins() {
		$bootstrap = $this->getApplication() ;
		
		if ($bootstrap instanceof Zend_Application) {
			$bootstrap = $this ;
		}
		$bootstrap -> bootstrap("FrontController");
		$front = $bootstrap->getResource("FrontController");
		$front -> registerPlugin(New TC_Plugins_Layout());
	}
	
	
}

