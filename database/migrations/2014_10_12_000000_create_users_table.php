<?php

use App\Repository\Models\User;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends F30_Migration {
  /**
   * constructor
   */
  public function __construct() {
    $this->table = (new User())->getTable();
  }

  /**
   * Run the migrations.
   */
  public function up() : void {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('first_name');
      $table->string('last_name')->nullable();
      $table->string('username', 28)->unique();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamp('locked_at')->nullable();
      $table->tinyInteger('login_fail_attempt', false, true)->default(0);

      // add timestamp to users table
      $this->addTimestamp($table, true);

      // add index into users
      $this->addIndex($table, ['email']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() : void {
    Schema::dropIfExists($this->getTable());
  }
};
