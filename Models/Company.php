<?php

namespace Models;

use Interfaces\FileConvertible;

class Company implements FileConvertible
{
  public string $name;
  public int $foundingYear;
  public string $website;
  public string $phone;
  public string $industry;
  public string $ceo;
  public bool $isPubliclyTraded;
  public string $country;
  public string $founder;
  public int $totalEmployees;

  public function __construct(
    string $name,
    int $foundingYear,
    string $website,
    string $phone,
    string $industry,
    string $ceo,
    bool $isPubliclyTraded,
    string $country,
    string $founder,
    int $totalEmployees,
  ) {
    $this->name = $name;
    $this->foundingYear = $foundingYear;
    $this->website = $website;
    $this->phone = $phone;
    $this->industry = $industry;
    $this->ceo = $ceo;
    $this->isPubliclyTraded = $isPubliclyTraded;
    $this->country = $country;
    $this->founder = $founder;
    $this->totalEmployees = $totalEmployees;
  }

  public function toString(): string
  {
    return sprintf(
      "Company Name: %s\n
      FoundingYear: %d\n
      Website: %s\n
      Phone Number: %d\n
      Industry: %s\n
      CEO: %s\n
      IsPubliclyTraded: %s\n
      Country: %s\n
      Founder: %s\n,
      TotalEmployees: %d\n",
      $this->name,
      $this->foundingYear,
      $this->website,
      $this->phone,
      $this->industry,
      $this->ceo,
      $this->isPubliclyTraded,
      $this->country,
      $this->founder,
      $this->totalEmployees,
    );
  }
  public function toHTML(): string
  {
    return 'aa';
  }
  public function toMarkdown(): string
  {
    return 'aa';
  }
  public function toArray(): array
  {
    return [];
  }
}
