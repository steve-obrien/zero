<?php

namespace Zero\Mvc;

class Route
{
	public string $app;
	public string $controller;
	public string $method;

	public function __construct(string $app, string $controller, string $method)
	{
		$this->app = $app;
		$this->controller = $controller;
		$this->method = $method;
	}
}
