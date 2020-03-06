<?php

namespace App\src\DAO;

class ChildDAO extends DAO
{	
	/**
	 * listChildren
	 *
	 * @return array $children
	 */
	public function listChildren()
	{
		$sql = 'SELECT id, last_name lastName, first_name firstName, birth_date birthDate
			FROM child ORDER BY birth_date ASC';
		$result = $this->createQuery($sql);
		$children = $result->fetchAll();
		$result->closeCursor();
		return $children;
	}
}