<?php
namespace Zero\Mvc;
/**
 * App class
 * 
 * This class is responsible for parsing the URL, determining the appropriate controller,
 * method, and parameters, and then executing the controller method with the parameters.
 */
class App
{
	protected $defaultApp = 'App';
	// The App
	protected $app;
	// Default controller
	protected string $defaultController = 'Index';

	// The controller instance
	protected Controller $controller;

	// The controller method that will serve the request
	protected string $defaultMethod = 'index';
	// Parameters to be passed to the method
	protected $params = [];
	// Singleton instance
	private static $instance = null;

	public Route $route;

	private function __construct()
	{
		// Parse the URL to get controller, method, and parameters
		$this->route = $this->parseUrl();
		$this->controller = $this->loadController($this->route);

		// Remove the controller from the URL array
		
		// Check if the method exists in the controller
		if (!method_exists($this->controller, $this->route->method)) {
			throw new \Exception("Controller method not found: {$this->route->method}");
		}

		// Remaining parts of the URL are parameters
		// $this->params = $url ? array_values($url) : [];
	}

	public function loadController(Route $route) : Controller
	{
		// Check controller file exists
		$controllerFile = DIR_ROOT.'/'.$route->app.'/Controllers/'.ucfirst($route->controller).'Controller.php';
		if (!file_exists($controllerFile))
			throw new \Exception("Controller file not found: $controllerFile");

		// Instantiate the controller class
		$controllerClass = $route->app . '\Controllers\\' . $route->controller . 'Controller'; 
		return new $controllerClass;
	}

	public function getController()
	{
		$this->controller;
	}

	public function getApp() {
		return $this->app;
	}

	/**
	 * Get the singleton instance of the App
	 * 
	 * @return App The singleton instance
	 */
	public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Run the application
	 * 
	 * This method executes the controller method with the parameters.
	 */
	public function run() : void
	{
		// Execute the controller method with the parameters
		call_user_func_array([$this->controller, $this->route->method], $this->params);
	}

	/**
	 * Parse the URL
	 * 
	 * This method parses the URL from the GET request, sanitizes it, and returns it as an array containing
	 * the App namespace, Controller name, and method.
	 * 
	 * @return array Parsed URL segments
	 */
	public function parseUrl($url=null) : Route
	{
		$url = $url ? $url : (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');
		$url = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));
		// If URL is empty, return default App, Controller, and Method
		if (empty($url[0])) {
			return new Route($this->defaultApp, $this->defaultController, $this->defaultMethod);
		}

		$appNamespace = isset($url[0]) ? $url[0] : $this->defaultApp;
		$controller = isset($url[1]) ? $url[1] : $this->defaultController;
		$method = isset($url[2]) ? $url[2] : $this->defaultMethod;

		// Check if the App namespace exists
		$appPath = DIR_ROOT . "/" . ucwords($appNamespace);
		if (!is_dir($appPath)) {
			// If App namespace does not exist
			// Then /defaultApp/controller/method
			$appNamespace = $this->defaultApp;
			$controller = isset($url[0]) ? $url[0] : $this->defaultController;
			$method = isset($url[1]) ? $url[1] : $this->defaultMethod;
			return new Route($appNamespace, $controller, $method);
		}

		// else if the app exists then assume app/controller/method
		return new Route($appNamespace, $controller, $method);
	}
}