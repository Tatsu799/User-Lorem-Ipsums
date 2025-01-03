<?php

namespace Models;

use Models\Employee;
use DateTime;

class restaurantLocation
{
  /**
   * @param Employee[]
   * */
  public string $name;
  public string $address;
  public string $city;
  public string $state;
  public string $zipCode;
  public array $employees;
  public bool $isOpen;

  public function __construct(
    string $name,
    string $address,
    string $city,
    string $state,
    string $zipCode,
    array $employee,
    bool $isOpen
  ) {
    $this->name = $name;
    $this->address = $address;
    $this->city = $city;
    $this->state = $state;
    $this->zipCode = $zipCode;
    $this->employees = $employee;
    $this->isOpen = $isOpen;
  }

  public function showCompanyInfo(): string
  {

    $employeesCount = count($this->employees);
    $isOpen = ($this->isOpen) ? 'Yes' : 'No';

    return sprintf(
      "Company Name: %s\n
      Address: %s\n
      City: %s\n
      Stste: %s\n
      Zip Code: %s\n
      Employees: %d\n
      IsOpen: %s\n",
      $this->name,
      $this->address,
      $this->city,
      $this->state,
      $this->zipCode,
      $employeesCount,
      $isOpen
    );
  }
}
