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

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * create new user_roles table this table will put all roles for
 * some users
 *
 * @author Fathalfath30
 *
 * @version 1.0.0
 * @since 1.0.0
 */
return new class extends F30_Migration {
  // set table name
  protected string $table = 'user_roles';

  public function __construct() {
    $this->table = (new UserRole())->getTable();
  }

  /**
   * Run the migrations.
   */
  public function up() : void {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id')
        ->primary();
      $table->uuid('user_id');
      $table->uuid('role_id');
      $table->tinyInteger('enabled', false, true)->default(0);

      // adding timestamp
      $this->addTimestamp($table);

      // add index
      $this->addIndex($table, ['user_id', 'role_id', 'enabled']);

      // adding foreign key
      $this->addForeign($table, 'user_id', (new User())->getTable());
      $this->addForeign($table, 'role_id', (new Role())->getTable());
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() : void {
    Schema::dropIfExists($this->getTable());
  }
};
