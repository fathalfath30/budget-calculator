<?php

use App\Helper\F30Migration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *  Migration class to create roles table that used
 * by users to get detail of what roles that he is
 * currently have
 *
 * @version 1.0.0
 * @since 0.1.0
 * @see \App\Helper\F30Migration
 * @author Fathalfath30
 *
 */
class CreateRolesTable extends F30Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   * @since 1.0.0
   */
  public function up()
  {
    Schema::create((new Role)->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->string('name');
      $table->longText('description')
        ->nullable();
      $table->timestamps();

      // set the primary key
      $table->primary('id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   * @since 1.0.0
   */
  public function down()
  {
    Schema::dropIfExists((new User)->getTable());
  }
}
