<?php

namespace App\src\model;

use DateTime;

class Child
{
	private $id;
	private $lastName;
	private $firstName;
	private $birthDate;

	public function __construct(array $data)
	{
		$this->hydrate($data);
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

	public function setId(string $value)
	{
		$this->id = htmlspecialchars($value);
	}
	public function getId()
	{
		return $this->id;
	}

	public function setLastName(string $value)
	{
		$this->lastName = htmlspecialchars($value);
	}
	public function getLastName()
	{
		return $this->lastName;
	}

	public function setFirstName(string $value)
	{
		$this->firstName = htmlspecialchars($value);
	}
	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setBirthDate(string $value)
	{

		$this->birthDate = new DateTime($value);
	}
	public function getBirthDate()
	{
		return $this->birthDate;
	}
}
