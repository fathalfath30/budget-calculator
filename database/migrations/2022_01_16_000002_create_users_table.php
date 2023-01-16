<?php

use App\Helper\F30Migration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Migration file to generate users table, this table will
 * require some table too, for now this only need roles.
 *
 * @version 1.0.0
 * @since 0.1.0
 *
 * @see \CreateRolesTable
 * @see \App\Helper\F30Migration
 *
 * @see \App\Models\User
 */
class CreateUsersTable extends F30Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create((new User)->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->string('name');
      $table->string('email')
        ->unique();
      $table->timestamp('email_verified_at')
        ->nullable();
      $table->string('password');
      $table->timestamp('password_updated_at')
        ->nullable()
        ->default(DB::raw('now()'));
      $table->uuid('role_id');

      $table->rememberToken();
      $table->timestamps();

      // set the primary key
      $table->primary('id');

      // add index on table
      $table->index(['email', 'role_id'], 'idx_users1', 'btree');

      // foreign key
      $table->foreign('role_id')
        ->references('id')
        ->on((new Role)->getTable())
        ->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists((new User)->getTable());
  }
}
