<?php

namespace App\config;

/**
 * Session
 * model access to $_SESSION
 */
class Session
{
	private $session;

	public function __construct($session)
	{
		$this->session = $session;
	}

	/**
	 * set $_SESSION variable
	 *
	 * @param  string $name
	 * @param  mixed $value
	 * @return void
	 */
	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}
	
	/**
	 * get $_SESSION variable
	 *
	 * @param  string $name
	 * @return mixed
	 */
	public function get($name)
	{
		if (isset($_SESSION[$name])) {
			return $_SESSION[$name];
		}
	}

	/**
	 * show momentary variable
	 *
	 * @param  string $name
	 * @return mixed
	 */
	public function show($name)
	{
		if (isset($_SESSION[$name])) {
			$key = $this->get($name);
			$this->remove($name);
			return $key;
		}
	}

	public function remove($name)
	{
		unset($_SESSION[$name]);
	}

	public function start()
	{
		session_start();
	}

	public function stop()
	{
		session_destroy();
	}
}
