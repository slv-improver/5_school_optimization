<?php

namespace App\src\model;

use DateTime;

class Attendance
{
	private $table = [];
	private $amount = [];
	private $day = [];

	public function __construct(array $data)
	{
		foreach ($data as $row) {
			// display data as [date] => attendance (0/.5/1)
			$this->table[$row['day']] = $row['amount'];
			$this->hydrate($row);
		}
	}
	
	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) {
			
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
	
	public function setAmount($value)
	{
		$this->amount[] = $value;
	}
	public function getAmount()
	{
		return $this->amount;
	}

	public function setDay($value)
	{
		$this->day[] = new DateTime($value);
	}
	public function getDay()
	{
		return $this->day;
	}
}
