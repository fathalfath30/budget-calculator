<?php

namespace Tests\TestData;

use App\Domain\Entity\Password;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Password
 *
 * @author Fathalfath30
 */
trait PasswordTestData {

  /**
   * Return sample password or confirm_password value
   *
   * @return string
   */
  public function getValidPassword() : string {
    return "Lupa@123";
  }

  /**
   * Return sample password_updated_at value
   *
   * @return string
   */
  public function getValidPasswordUpdatedAt() : string {
    return "2024-01-01 23:59:59";
  }

  /**
   * Return valid sample Password entity
   *
   * @param $withConfirm bool
   *
   * @return \App\Domain\Entity\Password
   */
  public function getPasswordEntity(bool $withConfirm = false) : Password {
    return Password::rebuild($this->getValidPassword(), (($withConfirm) ? $this->getValidPassword() : null),
      $this->getValidPasswordUpdatedAt());
  }
}
