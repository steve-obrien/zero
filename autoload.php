<?php
// Define the root directory
define('DIR_ROOT', __DIR__);

/**
 * Autoload function to automatically include PHP class files based on their namespace.
 *
 * This function registers an autoloader that converts a fully-qualified class name
 * into a file path and includes the file if it exists. The base directory for the
 * namespace prefix is set to the current directory.
 *
 * Example:
 * If a class named 'App\Controller\HomeController' is requested, this autoloader
 * will look for a file at 'App/Controller/HomeController.php' in the base directory.
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {
	// Base directory for the namespace prefix (adjust as needed)
	$base_dir = __DIR__ . '/';

	// Replace the namespace separator with the directory separator, append with .php
	$file = $base_dir . str_replace('\\', '/', $class) . '.php';

	// Require the file if it exists
	if (file_exists($file)) {
		require $file;
	}
});

// load in helper functions
require_once 'helpers.php';