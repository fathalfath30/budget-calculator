<?php

namespace Database\Seeders;

use App\Repository\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * RoleSeeder
 *
 * This class will seed default role that will be used by this application
 *
 * @author Fathalfath30
 *
 * @version 1.0.0
 * @since 1.0.0
 */
class RoleSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run() : void {
    $now = date('Y-m-d H:i:s');

    Role::factory()
      ->createMany([
        [
          Role::ID => DefaultRoleSuperAdminId,
          Role::NAME => DefaultRoleSuperAdminName,
          Role::LEVEL => DefaultRoleSuperAdminLevel,
          Model::CREATED_AT => $now,
          Model::UPDATED_AT => $now
        ],
        [
          Role::ID => DefaultRoleGuestId,
          Role::NAME => DefaultRoleGuestName,
          Role::LEVEL => DefaultRoleGuestLevel,
          Model::CREATED_AT => $now,
          Model::UPDATED_AT => $now
        ]
      ]);
  }
}
