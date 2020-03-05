<?php

namespace App\src\model;

use App\config\Request;

class View
{
	private $file;
	private $title;
	private $request;
	private $session;

	public function __construct()
	{
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
		$this->session = $this->request->getSession();
	}
	
	/**
	 * render
	 *
	 * @param  string $template
	 * @param  array $data
	 * @return void
	 */
	public function render($template, $data = [])
	{
		$this->file = '../src/view/' . $template . '.php';
		$content  = $this->renderFile($this->file, $data);
		$view = $this->renderFile('../src/view/base.php', [
			'title' => $this->title,
			'content' => $content,
			'session' => $this->session
		]);
		echo $view;
	}
	
	/**
	 * renderFile
	 *
	 * @param  string $file
	 * @param  array $data
	 * @return string output buffer
	 */
	private function renderFile($file, $data)
	{
		if (file_exists($file)) {
			extract($data);
			ob_start();
			require $file;
			return ob_get_clean();
		}
		header('Location: index.php?route=notFound');
	}
}
