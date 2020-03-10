<?php

namespace App\src\model;

class ParentOfChild
{
	private $id;
	private $rank;
	private $lastName;
	private $firstName;
	private $phone;
	private $mail;

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

	public function setId($value)
	{
		$this->id = htmlspecialchars($value);
	}
	public function getId()
	{
		return $this->id;
	}

	public function setRank($value)
	{
		if ($value === 'father' || $value === 'mother') {
			$this->rank = $value;
		}
	}
	public function getRank()
	{
		if ($this->rank === 'father') {
			return 'père';
		}
		if ($this->rank === 'mother') {
			return 'mère';
		}
	}

	public function setLastName($value)
	{
		$this->lastName = strtoupper(htmlspecialchars($value));
	}
	public function getLastName()
	{
		return $this->lastName;
	}

	public function setFirstName($value)
	{
		$this->firstName = ucfirst(htmlspecialchars($value));
	}
	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setPhone($value)
	{
		$this->phone = htmlspecialchars($value);
	}
	public function getPhone()
	{
		return $this->phone;
	}

	public function setMail($value)
	{
		$this->mail = htmlspecialchars($value);
	}
	public function getMail()
	{
		return $this->mail;
	}
}
