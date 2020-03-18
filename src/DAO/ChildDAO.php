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

	/**
	 * addChild insert new child in db & add column equal child id in attendance table
	 *
	 * @param  Parameter $post
	 * @return int count of affected lines
	 */
	public function addChild(Parameter $post)
	{
		$sql = 'INSERT INTO child (gender, last_name, first_name, birth_date, allergies, vaccines, other) 
			VALUES (?, ?, ?, ?, "", "", "")';
		$req = $this->createQuery($sql, [
			$post->get('gender'),
			$post->get('last_name'),
			$post->get('first_name'),
			$post->get('birth_date')
		]);

		$id = $this->createQuery('SELECT LAST_INSERT_ID()')->fetch()[0];
		$this->createQuery("ALTER TABLE `attendance` ADD `child$id` DECIMAL (2,1) NOT NULL DEFAULT '-1'");
		return $req;
	}

	/**
	 * deleteChild by id
	 *
	 * @param  int $childId
	 * @return int count of affected lines
	 */
	public function deleteChild($childId)
	{
		$sql = 'DELETE FROM child WHERE id = ?';
		$req = $this->createQuery($sql, [$childId]);
		$this->createQuery("ALTER TABLE `attendance` DROP `child$childId`");
		return $req;
	}
	
	/**
	 * childCard select all information from child by id
	 *
	 * @param  int $childId
	 * @return array $child
	 */
	public function childCard($childId)
	{
		$sql = 'SELECT id, gender, last_name lastName, first_name firstName, birth_date birthDate, address, allergies, vaccines, other
			FROM child WHERE id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$child = $result->fetch();
		$result->closeCursor();
		return $child;
	}
}
