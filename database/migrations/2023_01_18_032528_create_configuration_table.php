<?php

use App\Helper\F30Migration;
use App\Models\Configuration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateConfigurationTable
 * This migration will create 'configuration' table on database, and this
 * table should hold default configuration for the application and also
 * for the users
 *
 * @version 1.0.0
 * @since 0.1.0
 *
 * @author Fathalfath30
 */
class CreateConfigurationTable extends F30Migration
{

  /** @var null|\Illuminate\Database\Eloquent\Model|string $model */
  protected string $model = Configuration::class;

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->string('name')
        ->unique();
      $table->longText('description')
        ->nullable();
      $table->longText('default_value')
        ->nullable();
      $table->boolean('configurable')
        ->default(false);

      $table->timestamps();
      $table->softDeletes();

      // set primary key
      $table->primary('id');

      // set index
      $table->index(['name']);
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
