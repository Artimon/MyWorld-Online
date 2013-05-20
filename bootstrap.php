<?php

/*
 * Contains all code needed to start up the project.
 */

class Router {
	/**
	 * @var string
	 */
	private $route;

	/**
	 * @var array
	 */
	private $parameters;

	/**
	 * @param string $default
	 * @param string $error
	 */
	public function __construct($default, $error) {
		$request = array_key_exists('route', $_REQUEST)
			? $_REQUEST['route']
			: '';

		$parts = explode('/', $request);
		if ($parts[0]) {
			$route = $parts[0];
			unset($parts[0]);
		}
		else {
			$route = $default;
		}

		$routes = require_once 'source/config/routes.php';
		if (!array_key_exists($route, $routes)) {
			$route = $error;
			$parts = array();
		}

		$this->route = $routes[$route];
		$this->parameters = $parts;
	}

	/**
	 * @return ControllerInterface
	 */
	public function controller() {
		$controller = $this->route['controller'];

		return new $controller($this->parameters);
	}

	/**
	 * @return string
	 */
	public function route() {
		return $this->route;
	}
}

$router = new Router('login', 'notFound');


$baseDir = __DIR__;

require_once $baseDir . '/ext/valkyrie/valkyrie/Autoloader.php';

$autoloader = Valkyrie_Autoloader::create();
$autoloader
	->setScriptGroup($router->route())
	->setBuildPath($baseDir . '/source/build')
	->addSourcePath($baseDir . '/source/lib')
	->addSourcePath($baseDir . '/ext/lisbeth')
	->addSourcePath($baseDir . '/ext/leviathan')
	->lowerCasePaths()
	->start(false);

$controller = $router->controller();
$controller->index();