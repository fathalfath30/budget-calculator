<?php

use App\Repository\Models\User;
use App\Repository\Models\UserLoginHistory;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Budget
 *
 * This migration will create "user_login_history" table to store all login history
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \Database\Helper\F30_Migration
 */
return new class extends F30_Migration {
  /**
   * constructor
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function __construct() {
    $this->table = (new UserLoginHistory())->getTable();
  }

  /**
   * Run the migrations.
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function up() : void {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->uuid('user_id');
      $table->string('ip_address', 50);
      $table->text('user_agent')
        ->nullable();
      $table->tinyInteger('status', false, true)
        ->default(0)
        ->comment('0: failed; 1: success');

      // add timestamp
      $this->addTimestamp($table);

      // set primary key
      $table->primary(['id']);

      // add index
      $this->addIndex($table, ['user_id', 'status']);

      // add foreign key
      $this->addForeign($table, 'user_id', (new User())->getTable());
    });
  }

  /**
   * Reverse the migrations.
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function down() : void {
    Schema::dropIfExists($this->getTable());
  }
};
