<?php

namespace Database\Factories;

use App\Repository\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Repository\Models\User>
 */
class UserFactory extends Factory {
  /** @var string $model */
  protected $model = User::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition() : array {
    $now = date('Y-m-d H:i:s');
    return [
      User::ID => $this->faker->uuid(),
      User::FIRST_NAME => $this->faker->firstName,
      User::LAST_NAME => $this->faker->lastName,
      User::USERNAME => $this->faker->userName,
      User::EMAIL => $this->faker->safeEmail,
      User::EMAIL_VERIFIED_AT => $now,
      User::REMEMBER_TOKEN => null,
      User::LOCKED_AT => null,
      User::LOGIN_FAIL_ATTEMPT => 0,
      User::CREATED_AT => $now,
      User::UPDATED_AT => $now,
      User::DELETED_AT => null
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified() : static {
    return $this->state(fn(array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
