<?php

namespace App\Providers;

use App\Domain\Repository\IRoleRepository;
use App\Repository\RoleRepository;
use Illuminate\Support\ServiceProvider;

/**
 * BudgetCalculatorServiceProvider
 *
 * @author fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \Illuminate\Support\ServiceProvider
 * @see \App\Domain\Repository\IRoleRepository
 * @see \App\Repository\RoleRepository
 */
class BudgetCalculatorServiceProvider extends ServiceProvider {
  /**
   * Registering repository
   *
   * @return void
   * @version 1.0.0
   */
  private function registerRepository() : void {
    $this->app->bind(IRoleRepository::class, RoleRepository::class);
  }

  /**
   * Register any application services.
   *
   * @return void
   * @version 1.0.0
   */
  public function register() : void {
    $this->registerRepository();
  }
}
