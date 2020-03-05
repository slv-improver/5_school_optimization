<?php

namespace App\src\controller;

/**
 * ErrorController redirect to error_page
 */
class ErrorController extends Controller
{
	public function errorNotFound()
	{
		return $this->view->render('error_404');
	}

	public function errorServer()
	{
		return $this->view->render('error_500');
	}
}
