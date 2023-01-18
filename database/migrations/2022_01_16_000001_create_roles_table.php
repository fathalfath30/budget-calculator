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
  /** @var null|\Illuminate\Database\Eloquent\Model|string $model */
  protected string $model = Role::class;

  /**
   * Run the migrations.
   *
   * @return void
   * @since 1.0.0
   */
  public function up()
  {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->string('name');
      $table->longText('description')
        ->nullable();

      $table->timestamps();
      $table->softDeletes();

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
    Schema::dropIfExists($this->getTable());
  }
}
