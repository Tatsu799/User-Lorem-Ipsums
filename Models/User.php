<?php

namespace Models;

use DateTime;

class User
{
  private int $id;
  private string $firstName;
  private string $lastName;
  private string $email;
  private string $hashedPassword;
  private string $phoneNumber;
  private string $address;
  private dateTime $birthDate;
  private dateTime $membershipExpirationDate;
  private string $role;
  private bool $isActive;

  public function __construct(
    int $id,
    string $firstName,
    string $lastName,
    string $email,
    string $password,
    string $phoneNumber,
    string $address,
    dateTime $birthDate,
    dateTime $membershipExpirationDate,
    string $role,
  ) {
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->hashedPassword = $password;
    $this->phoneNumber = $phoneNumber;
    $this->address = $address;
    $this->birthDate = $birthDate;
    $this->membershipExpirationDate = $membershipExpirationDate;
    $this->role = $role;
    $this->isActive = false;
  }

  public function login($password): bool
  {
    return password_verify($password, $this->hashedPassword);
  }

  public function updateProfile(string $address, string $phoneNumber): void
  {
    $this->address = $address;
    $this->phoneNumber = $phoneNumber;
  }

  public function renewMembership(DateTime $expirationDate): void
  {
    $this->membershipExpirationDate = $expirationDate;
  }

  public function changePassword(string $newPassword): void
  {
    $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  }

  public function hasMembershipExpired(): bool
  {
    $currentDate = new DateTime();
    return $currentDate > $this->membershipExpirationDate;
  }

  public function toString(): string
  {
    return sprintf(
      "User ID: %d\nName: %s %s\nEmail: %s\nPhone Number: %s\nAddress: %s\nBirth Date: %s\nMembership Expiration Date: %s\nRole: %s\n",
      $this->id,
      $this->firstName,
      $this->lastName,
      $this->email,
      // $this->hashedPassword,
      $this->phoneNumber,
      $this->address,
      $this->birthDate->format('Y'),
      $this->membershipExpirationDate->format('Y'),
      $this->role,
    );
  }

  public function toHTML()
  {
    return sprintf(
      "
      <div class='user-card'>
          <div class='avatar'>SAMPLE</div>
          <h2>%s %s</h2>
          <p>%s</p>
          <p>%s</p>
          <p>%s</p>
          <p>Birth Date: %s</p>
          <p>Membership Expiration Date: %s</p>
          <p>Role: %s</p>
      </div>",
      $this->firstName,
      $this->lastName,
      $this->email,
      $this->phoneNumber,
      $this->address,
      $this->birthDate->format('Y-m-d'),
      $this->membershipExpirationDate->format('Y-m-d'),
      $this->role,
    );
  }

  public function toMarkdown()
  {
    return "## User: {$this->firstName} {$this->lastName}
    - Email: {$this->email}
    - Phone Number: {$this->phoneNumber}
    - Address: {$this->address}
    - Birth Date: {$this->birthDate}
    - Is Actieve: {$this->isActive}
    - Role: {$this->role}
    ";
  }

  public function toArray()
  {
    return [
      'id' => $this->id,
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'email' => $this->email,
      'password' => $this->hashedPassword,
      'phoneNumber' => $this->phoneNumber,
      'address' => $this->address,
      'birthDate' => $this->birthDate,
      'isActive' => $this->isActive,
      'role' => $this->role
    ];
  }
}
