<?php

namespace App\src\DAO;

use App\config\Parameter;

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

	public function addChild(Parameter $post)
	{
		$sql = 'INSERT INTO child (last_name, first_name, birth_date) 
			VALUES (?, ?, ?)';
		return $this->createQuery($sql, [
			$post->get('last_name'), 
			$post->get('first_name'), 
			$post->get('birth_date')
		]);
	}

	public function deleteChild($childId)
	{
		$sql = 'DELETE FROM child WHERE id = ?';
		return $this->createQuery($sql, [$childId]);
	}
}
