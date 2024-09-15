<?php
use \Zero\Mvc\App;

function dd(...$args) {
	var_dump(...$args);
	die();
}
/**
 * Helper function to get the App instance
 * 
 * @return App The singleton instance of the App
 */
function app()
{
	return App::getInstance();
}
