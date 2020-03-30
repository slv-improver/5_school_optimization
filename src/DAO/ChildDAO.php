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
	public function listChildren($from, $max = null)
	{
		if (!isset($max)) {
			$max = $this->countChildren();
		}
		$sql = "SELECT id, last_name lastName, first_name firstName, birth_date birthDate
			FROM child ORDER BY birth_date ASC LIMIT $from, $max";
		$result = $this->createQuery($sql);
		$children = $result->fetchAll();
		$result->closeCursor();
		return $children;
	}
		
	/**
	 * countChildren
	 *
	 * @return int number of children
	 */
	public function countChildren()
	{
		return (int) $this->createQuery('SELECT COUNT(id) FROM child')->fetch()[0];
	}

	/**
	 * addChild insert new child in db & add column equal child id in attendance table
	 *
	 * @param  Parameter $post
	 * @return int count of affected lines
	 */
	public function addChild(Parameter $post, $fatherId, $motherId)
	{
		$sql = 'INSERT INTO child (gender, last_name, first_name, birth_date,
				father_id, mother_id, address, allergies, vaccines, other) 
			VALUES (:gender, :last_name, :first_name, :birth_date,
				:father_id, :mother_id, :address, :allergies, :vaccines, :other)';
		$req = $this->createQuery($sql, [
			":gender" => $post->get('gender'),
			":last_name" => $post->get('last_name'),
			":first_name" => $post->get('first_name'),
			":birth_date" => $post->get('birth_date'),
			":father_id" => $fatherId,
			":mother_id" => $motherId,
			":address" => $post->get('address'),
			":allergies" => $post->get('allergies'),
			":vaccines" => $post->get('vaccines'),
			":other" => $post->get('other'),

		]);

		$childId = $this->createQuery('SELECT LAST_INSERT_ID()')->fetch()[0];
		$this->createQuery("ALTER TABLE `attendance` ADD `child$childId` DECIMAL (2,1) NOT NULL DEFAULT '-1'");
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
		$this->createQuery(
			'DELETE FROM responsable WHERE id = 
				(SELECT father_id FROM child WHERE id = :childId)
				|| id =
				(SELECT mother_id FROM child WHERE id = :childId)',
			[':childId' => $childId]
		);
		$sql = 'DELETE FROM child WHERE id = ?';
		$req = $this->createQuery($sql, [$childId]);
		$this->createQuery("ALTER TABLE `attendance` DROP `child$childId`");

		// delete parents

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

	public function addDocument($url, $title, $childId)
	{
		$sql = 'INSERT INTO document VALUE (NULL, ?, ?, ?)';
		$req = $this->createQuery($sql, [$url, $title, $childId]);
		return $req;
	}

	public function getDocuments($childId)
	{
		$sql = 'SELECT url, title FROM document WHERE child_id = ?';
		$result = $this->createQuery($sql, [$childId]);
		return $result->fetchAll();
	}
}
