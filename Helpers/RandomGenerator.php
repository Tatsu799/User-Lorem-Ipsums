<?php

namespace Helpers;

use Faker\Factory;
use Models\User;
use Models\Employee;
use Models\RestaurantLocation;
use Models\RestaurantChain;

class RandomGenerator
{
  public static function user(): User
  {
    $faker = Factory::create();

    return new User(
      $faker->randomNumber(),
      $faker->firstName(),
      $faker->lastName(),
      $faker->email,
      $faker->password,
      $faker->phoneNumber,
      $faker->address,
      $faker->dateTimeThisCentury,
      $faker->dateTimeBetween('-10 years', '+20 years'),
      $faker->randomElement(['admin', 'user', 'editor'])
    );
  }

  public static function users(int $min, int $max): array
  {
    $faker = Factory::create();
    $users = [];
    $numOfUsers = $faker->numberBetween($min, $max);

    for ($i = 0; $i < $numOfUsers; $i++) {
      $users[] = self::user();
    }

    return $users;
  }

  public static function employee(): Employee
  {
    $faker = Factory::create();

    return new Employee(
      $faker->randomNumber(),
      $faker->firstName(),
      $faker->lastName(),
      $faker->email,
      $faker->password,
      $faker->phoneNumber,
      $faker->address,
      $faker->dateTimeThisCentury,
      $faker->dateTimeBetween('-10 years', '+20 years'),
      $faker->randomElement(['admin', 'user', 'editor']),
      $faker->jobTitle(),
      $faker->numberBetween(1000, 50000),
      $faker->dateTimeBetween('-10 years', '+20 years'),
      $faker->shuffleArray(['Employee of the Month', 'Best Innovator']),
    );
  }

  public static function employees(): array
  {
    $faker = Factory::create();
    $employees = [];
    $numOfemployees = $faker->numberBetween(2, 5);

    for ($i = 0; $i < $numOfemployees; $i++) {
      $employees[] = self::employee();
    }

    return $employees;
  }

  public static function restaurantLocation(): RestaurantLocation
  {
    $faker = Factory::create();

    return new RestaurantLocation(
      $faker->company(),
      $faker->country(),
      $faker->city(),
      $faker->streetName(),
      $faker->streetAddress(),
      $faker->shuffleArray(RandomGenerator::employees()),
      $faker->boolean(),
    );
  }

  public static function restaurantLocations(): array
  {
    $faker = Factory::create();
    $restaurantLocations = [];
    $numOfrestaurant = $faker->numberBetween(2, 5);

    for ($i = 0; $i < $numOfrestaurant; $i++) {
      $restaurantLocations[] = self::restaurantLocation();
    }

    return $restaurantLocations;
  }

  public static function restaurantChain(): RestaurantChain
  {
    $faker = Factory::create();

    $locations = RandomGenerator::restaurantLocations();
    $numberOfLocations = count($locations);

    return new RestaurantChain(
      $faker->company(),
      $faker->dateTimeBetween('-10 years', '+20 years')->format('Y'),
      $faker->url(),
      $faker->phoneNumber(),
      $faker->randomElement(['IT', 'FOOD']),
      $faker->name(),
      $faker->boolean(),
      $faker->country(),
      $faker->company(),
      $faker->randomDigit(), ///employee count
      $faker->randomDigit(),
      $faker->randomElement(['Japanese Food', 'Italan Food']),
      $faker->shuffleArray($locations),
      $faker->randomElement([$numberOfLocations]),
      $faker->dateTimeBetween('-10 years', '+20 years')->format('Y'),
      $faker->boolean(),
      $faker->company(),
    );
  }

  public static function restaurantChains(int $min, int $max)
  {
    $faker = Factory::create();
    $restaurantChains = [];
    $numOfRestaurant = $faker->numberBetween($min, $max);

    for ($i = 0; $i < $numOfRestaurant; $i++) {
      $restaurantChains[] = self::restaurantChain();
    }

    return $restaurantChains;
  }
}
