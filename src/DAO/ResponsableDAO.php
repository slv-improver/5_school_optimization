<?php

namespace App\src\DAO;

use App\config\Parameter;

class ResponsableDAO extends DAO
{
	public function addFather(Parameter $post)
	{
		$sql = 'INSERT INTO responsable (last_name, first_name, phone, mail, `rank`)
				VALUES (?, ?, ?, ?, "father")';
		$this->createQuery($sql, [
			$post->get('f_last_name'),
			$post->get('f_first_name'),
			$post->get('f_phone'),
			$post->get('f_mail'),
		]);
		return $this->createQuery('SELECT LAST_INSERT_ID()')->fetch()[0];
	}

	public function addMother(Parameter $post)
	{
		$sql = 'INSERT INTO responsable (last_name, first_name, phone, mail, `rank`)
				VALUES (?, ?, ?, ?, "mother")';
		$this->createQuery($sql, [
			$post->get('m_last_name'),
			$post->get('m_first_name'),
			$post->get('m_phone'),
			$post->get('m_mail'),
		]);
		return $this->createQuery('SELECT LAST_INSERT_ID()')->fetch()[0];
	}

	/**
	 * getParents of child 
	 *
	 * @param  mixed $childId
	 * @return array $parents
	 */
	public function getParents($childId)
	{
		$sql = 'SELECT r.rank, r.last_name lastName, r.first_name firstName, r.phone, r.mail 
			FROM child c LEFT JOIN responsable r ON father_id = r.id || mother_id = r.id WHERE c.id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$parents = $result->fetchAll();
		$result->closeCursor();
		return $parents;
	}
}
