<?php

namespace Database\Seeders;

use App\Repository\Models\Role;
use App\Repository\Models\User;
use App\Repository\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

/**
 * UserSeeder
 *
 * This class will seed default user that will be used by this application
 *
 * @author Fathalfath30
 *
 * @version 1.0.0
 * @since 1.0.0
 */
class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run() : void {
    $now = date('Y-m-d H:i:s');
    User::factory()
      ->createMany([
        [
          User::ID => DEFAULT_USER_SUPER_ADMIN_ID,
          User::FIRST_NAME => 'Super',
          User::LAST_NAME => 'Admin',
          User::USERNAME => 'admin',
          User::EMAIL => 'admin@fathalfath30.github.io',
          User::EMAIL_VERIFIED_AT => $now,
          User::PASSWORD => '',
        ],
        [
          User::ID => DEFAULT_USER_GUEST_ID,
          User::FIRST_NAME => 'Guest',
          User::LAST_NAME => null,
          User::USERNAME => 'guest',
          User::EMAIL => 'guest@fathalfath30.github.io',
          User::EMAIL_VERIFIED_AT => $now,
          User::PASSWORD => ''
        ]
      ]);

    // adding role to each user
    // super administrator
    UserRole::create([
      UserRole::ID => Uuid::uuid4()->toString(),
      UserRole::USER_ID => DEFAULT_USER_SUPER_ADMIN_ID,
      UserRole::ROLE_ID => DEFAULT_ROLE_SUPER_ADMIN_ID,
      UserRole::ENABLED => 1,
      UserRole::CREATED_AT => $now,
      UserRole::UPDATED_AT => $now
    ]);

    // guest

    UserRole::create([
      UserRole::ID => Uuid::uuid4()->toString(),
      UserRole::USER_ID => DEFAULT_USER_GUEST_ID,
      UserRole::ROLE_ID => DEFAULT_ROLE_GUEST_ID,
      UserRole::ENABLED => 1,
      UserRole::CREATED_AT => $now,
      UserRole::UPDATED_AT => $now
    ]);
  }
}
