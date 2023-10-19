<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder
 *
 * @version 1.0.0
 * @since 1.0.0
 */
class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   */
  public function run() : void {
    $this->call([
      RoleSeeder::class,
      UserSeeder::class,
    ]);
  }
}
