<?php

namespace App\src\DAO;

use PDO;
use Exception;

abstract class DAO
{

	/**
	 * connection
	 *
	 * @var PDO object
	 */
	private $connection;
	
	/**
	 * getConnection
	 *
	 * @return void
	 */
	public function getConnection()
	{
		try {
			$this->connection = new PDO(DB_HOST, DB_USER, DB_PASSWD); /* CONSTANTS defined in config/ */
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $this->connection;
		} catch (Exception $e) {
			die('Erreur de connection :' . $e->getMessage());
		}
	}

	
	/**
	 * checkConnection etablishes connection if not exists
	 * return it if exists
	 *
	 * @return PDO object
	 */
	private function checkConnection()
	{
		if ($this->connection === null) {
			return $this->getConnection();
		}
		return $this->connection;
	}

	/**
	 * createQuery prepare and execute sql request if $parameters defined
	 *
	 * @param  string $sql
	 * @param  array $parameters
	 * @return PDOStatement
	 */
	protected function createQuery($sql, $parameters = null)
	{ 
		if ($parameters) {
			$result =  $this->checkConnection()->prepare($sql);
			$result->execute($parameters);
			return $result;
		}
		$result =  $this->checkConnection()->query($sql);
		return $result;
	}
}
