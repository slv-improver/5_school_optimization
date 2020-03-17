<?php

namespace App\src\DAO;

class ResponsableDAO extends DAO
{
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
}
