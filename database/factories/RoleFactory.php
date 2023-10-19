<?php
/*
//
//  ______    _   _           _  __      _   _     ____   ___
// |  ____|  | | | |         | |/ _|    | | | |   |___ \ / _ \
// | |__ __ _| |_| |__   __ _| | |_ __ _| |_| |__   __) | | | |
// |  __/ _` | __| '_ \ / _` | |  _/ _` | __| '_ \ |__ <| | | |
// | | | (_| | |_| | | | (_| | | || (_| | |_| | | |___) | |_| |
// |_|  \__,_|\__|_| |_|\__,_|_|_| \__,_|\__|_| |_|____/ \___/
//
// Written by Fathalfath30.
// Email : fathalfath30@gmail.com
// Follow me on:
//  Github : https://github.com/fathalfath30
//  Gitlab : https://gitlab.com/Fathalfath30
//
*/

namespace Database\Factories;

use App\Repository\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory {
  /** @var string $model */
  protected $model = Role::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition() : array {
    $now = date('Y-m-d H:i:s');
    return [
      Role::ID => $this->faker->uuid(),
      Role::NAME => $this->faker->jobTitle,
      Role::LEVEL => rand(1, 9),
      Role::CREATED_AT => $now,
      Role::UPDATED_AT => $now,
      Role::DELETED_AT => null
    ];
  }
}
