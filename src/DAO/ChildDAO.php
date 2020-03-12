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
		$sql = 'INSERT INTO child (gender, last_name, first_name, birth_date, allergies, vaccines, other) 
			VALUES (?, ?, ?, ?, "", "", "")';
		$req = $this->createQuery($sql, [
			$post->get('gender'),
			$post->get('last_name'),
			$post->get('first_name'),
			$post->get('birth_date')
		]);

		$id = $this->createQuery('SELECT LAST_INSERT_ID()')->fetch()[0];
		$this->createQuery("ALTER TABLE `attendance` ADD `$id` DECIMAL (2,1) NOT NULL DEFAULT '-1'");
		return $req;
	}

	public function deleteChild($childId)
	{
		$sql = 'DELETE FROM child WHERE id = ?';
		$req = $this->createQuery($sql, [$childId]);
		$this->createQuery("ALTER TABLE `attendance` DROP `$childId`");
		return $req;
	}

	public function childCard($childId)
	{
		$sql = 'SELECT id, gender, last_name lastName, first_name firstName, birth_date birthDate, address, allergies, vaccines, other
			FROM child WHERE id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$child = $result->fetch();
		$result->closeCursor();
		return $child;
	}

	/**
	 * getParents of child 
	 *
	 * @param  mixed $childId
	 * @return array $parents
	 */
	public function getParents($childId)
	{
		$sql = 'SELECT p.rank, p.last_name lastName, p.first_name firstName, p.phone, p.mail 
			FROM child c LEFT JOIN parent p ON father_id = p.id || mother_id = p.id WHERE c.id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$parents = $result->fetchAll();
		$result->closeCursor();
		return $parents;
	}
	/* 
	public function getFather($childId)
	{
		$sql = 'SELECT p.id, p.rank, p.last_name lastName, p.first_name firstName, p.phone, p.mail 
			FROM child c LEFT JOIN parent p ON father_id = p.id WHERE c.id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$father = $result->fetch();
		$result->closeCursor();
		return $father;
	}
	public function getMother($childId)
	{
		$sql = 'SELECT p.id, p.rank, p.last_name lastName, p.first_name firstName, p.phone, p.mail 
			FROM child c LEFT JOIN parent p ON mother_id = p.id WHERE c.id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$mother = $result->fetch();
		$result->closeCursor();
		return $mother;
	} */
	protected function rowExists($day)
	{
		$sql = 'SELECT id, day FROM attendance WHERE day = ?';
		$exists = $this->createQuery($sql, [$day])->fetch();
		return $exists;
	}
	protected function updateRow($rowId, $childId, $amount)
	{
		$sql = "UPDATE attendance SET `$childId` = ? WHERE id = ?";
		$this->createQuery($sql, [$amount, $rowId]);
	}
	protected function insertRow($childId, $day, $amount)
	{
		$sql = "INSERT INTO attendance (day, `$childId`) VALUE (?, ?)";
		$this->createQuery($sql, [$day, $amount]);
	}
	public function manageAttendance($childId, $day, $amount)
	{
		$rowId = $this->rowExists($day)['id'];
		if ($rowId) {
			echo 'good';
			$this->updateRow($rowId, $childId, $amount);
		} else {
			echo 'cool';
			$this->insertRow($childId, $day, $amount);
		}
	}
}
