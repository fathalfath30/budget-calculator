<?php

use App\Helper\F30Migration;
use App\Models\Configuration;
use App\Models\User;
use App\Models\UserConfig;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateUserSettingsTable will handle all migration for 'user_settings'.
 * This table should hold all configurable setting from 'configuration'
 * table that have 'configurable' field is true
 *
 * @version 1.0.0
 * @since 0.1.0
 * @see \App\Models\User
 * @see \App\Models\Configuration
 *
 * @author Fathalfath30
 *
 */
class CreateUserConfigTable extends F30Migration
{
  protected string $model = UserConfig::class;

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->uuid('user_id');
      $table->uuid('configuration_id');
      $table->longText('user_value')
        ->nullable();

      $table->timestamps();

      // add primary key
      $table->primary('id');

      // add index
      $table->index(['user_id', 'configuration_id'], 'idx_user_settings0', 'btree');

      // add foreign key
      $table->foreign('user_id', 'fk_user_setting0')
        ->references('id')
        ->on((new User)->getTable())
        ->onUpdate('cascade')
        ->onDelete('cascade');

      // add foreign key
      $table->foreign('configuration_id', 'fk_user_setting1')
        ->references('id')
        ->on((new Configuration)->getTable())
        ->onUpdate('cascade')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists($this->getTable());
  }
}
