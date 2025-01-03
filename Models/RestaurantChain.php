<?php

namespace Models;

class RestaurantChain extends Company
{
  /**
   * @param array<RestrauntLocation>
   * */
  public int $chainId;
  public array $restaurantLocations;
  public string $cuisineType;
  public int $numberOfLocations;
  public bool $hasDriveThur;
  public int $yearFounded;
  public string $parentCompany;

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
    ///
    int $chainId,
    string $cuisineType,
    array $restaurantLocations,
    int $numberOfLocations,
    bool $hasDriveThur,
    int $yearFounded,
    string $parentCompany,
  ) {
    parent::__construct(
      $name,
      $foundingYear,
      $website,
      $phone,
      $industry,
      $ceo,
      $isPubliclyTraded,
      $country,
      $founder,
      $totalEmployees,
    );
    $this->chainId = $chainId;
    $this->restaurantLocations = $restaurantLocations;
    $this->cuisineType = $cuisineType;
    $this->numberOfLocations = $numberOfLocations;
    $this->hasDriveThur = $hasDriveThur;
    $this->yearFounded = $yearFounded;
    $this->parentCompany = $parentCompany;
  }

  public function showChainInfo(): string
  {
    return sprintf(
      "Chain ID: %d\n
      RestaurantLocations: %s\n
      CuisineType: %s\n
      NumberOfLocations: %d\n
      HasDriveThur: %s\n
      YearFounded: %s\n
      ParentCompany: %s\n",
      $this->chainId,
      $this->restaurantLocations,
      $this->cuisineType,
      $this->numberOfLocations,
      $this->hasDriveThur,
      $this->yearFounded,
      $this->parentCompany
    );
  }
}
