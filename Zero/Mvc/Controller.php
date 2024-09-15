<?php

namespace Zero\Mvc;

class Controller
{
	public function view($view, $data = [])
	{
		require_once DIR_ROOT . '/App/Views/' . $view . '.php';
	}
}
