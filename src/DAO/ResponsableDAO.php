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
		$sql = 'SELECT r.rank, r.last_name lastName, r.first_name firstName, r.phone, r.mail 
			FROM child c LEFT JOIN responsable r ON father_id = r.id || mother_id = r.id WHERE c.id = ?';
		$result = $this->createQuery($sql, [$childId]);
		$parents = $result->fetchAll();
		$result->closeCursor();
		return $parents;
	}
}
