<?php

namespace App\src\model;

use DateTime;

class Child
{
	private $id;
	private $lastName;
	private $firstName;
	private $birthDate;
	private $father;
	private $mother;
	private $allergies;
	private $vaccines;

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
		$this->lastName = strtoupper(htmlspecialchars($value));
	}
	public function getLastName()
	{
		return $this->lastName;
	}

	public function setFirstName(string $value)
	{
		$this->firstName = ucfirst(htmlspecialchars($value));
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

	public function setAddress(string $value)
	{
		$this->address = htmlspecialchars($value);
	}
	public function getAddress()
	{
		return $this->address;
	}
	
	public function setFather(array $value)
	{
		$this->father = new ParentOfChild($value);
	}
	public function getFather()
	{
		return $this->father;
	}

	public function setMother(array $value)
	{
		$this->mother = new ParentOfChild($value);
	}
	public function getMother()
	{
		return $this->mother;
	}

	public function setAllergies(string $value)
	{
		$this->allergies = htmlspecialchars($value);
	}
	public function getAllergies()
	{
		return $this->allergies;
	}

	public function setVaccines(string $value)
	{
		$this->vaccines = htmlspecialchars($value);
	}
	public function getVaccines()
	{
		return $this->vaccines;
	}
}
