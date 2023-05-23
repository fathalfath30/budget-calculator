<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\TransactionHistory;
use App\Models\User;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * TransactionHistory
 *
 * This migration file will create transaction_history table to keep
 * user transaction history
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
    $this->table = (new TransactionHistory())->getTable();
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
      $table->uuid('new_id')
        ->nullable();
      $table->uuid('category_id')
        ->nullable();
      $table->uuid('user_id');
      $table->tinyInteger('history_type', false, true)
        ->comment('0: income; 1: expense; 2: transfer; default: income(0)')
        ->default('0');
      $table->decimal('amount', 15, 2)
        ->default(0);
      $table->longText('note')
        ->nullable();
      $table->uuid('account_id');
      $table->string('update_reason')
        ->nullable();

      // add timestamp
      $this->addTimestamp($table);

      // set primary key
      $table->primary(['id']);

      // add index
      $this->addIndex($table, ['history_type', 'created_at']);
      $this->addIndex($table, ['new_id', 'category_id', 'user_id', 'account_id']);

      // add foreign key
      $this->addForeign($table, 'new_id', $this->getTable());
      $this->addForeign($table, 'category_id', (new Category())->getTable());
      $this->addForeign($table, 'account_id', (new Account())->getTable());
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
