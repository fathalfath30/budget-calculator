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
          Role::ID => '8626e795-4079-4e4d-9e34-98b4aa4fec4f',
          Role::NAME => 'Super Administrator',
          Role::LEVEL => 999,
          Model::CREATED_AT => $now,
          Model::UPDATED_AT => $now
        ],
        [
          Role::ID => '304de370-bf18-4a26-8ee8-aaa6eab47955',
          Role::NAME => 'Guest',
          Role::LEVEL => 0,
          Model::CREATED_AT => $now,
          Model::UPDATED_AT => $now
        ]
      ]);
  }
}
