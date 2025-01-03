<?php

namespace Models;

use DateTime;

class Employee extends User
{
  public string $jobTitle;
  public float $salary;
  public DateTime $startDate;
  /**
   * @param array<string>
   */
  public array $awards;

  public function __construct(
    int $id,
    string $firstName,
    string $lastName,
    string $email,
    string $password,
    string $phoneNumber,
    string $address,
    DateTime $birthDate,
    DateTime $membershipExpirationDate,
    string $role,
    string $jobTitle,
    float $salary,
    DateTime $startDate,
    array $awards = [],
  ) {
    parent::__construct(
      $id,
      $firstName,
      $lastName,
      $email,
      $password,
      $phoneNumber,
      $address,
      $birthDate,
      $membershipExpirationDate,
      $role,
    );
    $this->jobTitle = $jobTitle;
    $this->salary = $salary;
    $this->startDate = $startDate;
    $this->awards = $awards;
  }

  public function toString(): string
  {
    $parentString = parent::toString();

    $awardsString = empty($this->awards) ? 'None' : implode(',', $this->awards);


    $additionalInfo = sprintf(
      "Job Title: %s\nSalary: %.2f\nStartDate: %s\n Awards: %s",
      $this->jobTitle,
      $this->salary,
      $this->startDate->format('Y-m-d'),
      $awardsString,
    );

    return $parentString . $additionalInfo;
  }
}
