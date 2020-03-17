<?php

namespace App\src\DAO;

class AttendanceDAO extends DAO
{
	/**
	 * rowExists returns row if exists in table
	 *
	 * @param string $day format 'yyyy-mm-dd'
	 * @return array $exists
	 */
	protected function rowExists($day)
	{
		$sql = 'SELECT id, day FROM attendance WHERE day = ?';
		$exists = $this->createQuery($sql, [$day])->fetch();
		return $exists;
	}
	/**
	 * updateRow
	 *
	 * @param int $rowId
	 * @param int $childId
	 * @param float $amount
	 * @return PDOStatement|bool
	 */
	protected function updateRow($rowId, $childId, $amount)
	{
		$sql = "UPDATE attendance SET `$childId` = ? WHERE id = ?";
		return $this->createQuery($sql, [$amount, $rowId]);
	}
	/**
	 * insertRow
	 *
	 * @param int $childId
	 * @param string $day
	 * @param float $amount
	 * @return PDOStatement|bool
	 */
	protected function insertRow($childId, $day, $amount)
	{
		$sql = "INSERT INTO attendance (day, `$childId`) VALUE (?, ?)";
		return $this->createQuery($sql, [$day, $amount]);
	}
	/**
	 * manageAttendance use id of existing row to update it or insert new row if not exists
	 *
	 * @param int $childId
	 * @param string $day
	 * @param float $amount
	 * @return PDOStatement|bool
	 */
	public function manageAttendance($childId, $day, $amount)
	{
		$rowId = $this->rowExists($day)['id'];
		if ($rowId) {
			return $this->updateRow($rowId, $childId, $amount);
		} else {
			return $this->insertRow($childId, $day, $amount);
		}
	}
}
