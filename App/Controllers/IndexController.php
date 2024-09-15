<?php

namespace App\Controllers;

use Zero\Mvc\Controller;

class IndexController extends Controller
{
	public function index()
	{
		$this->view('index');
	}

	public function contact()
	{
		$this->view('contact');
	}
}
