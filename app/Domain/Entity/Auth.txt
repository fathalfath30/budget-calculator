<?php
/*
//
//  ______    _   _           _  __      _   _     ____   ___
// |  ____|  | | | |         | |/ _|    | | | |   |___ \ / _ \
// | |__ __ _| |_| |__   __ _| | |_ __ _| |_| |__   __) | | | |
// |  __/ _` | __| '_ \ / _` | |  _/ _` | __| '_ \ |__ <| | | |
// | | | (_| | |_| | | | (_| | | || (_| | |_| | | |___) | |_| |
// |_|  \__,_|\__|_| |_|\__,_|_|_| \__,_|\__|_| |_|____/ \___/
//
// Written by Fathalfath30.
// Email : fathalfath30@gmail.com
// Follow me on:
//  Github : https://github.com/fathalfath30
//  Gitlab : https://gitlab.com/Fathalfath30
//
*/

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\Entity;
use App\Domain\Entity\Traits\ToArray;
use App\Exceptions\EntityValidationException;

/**
 * Auth
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\ToArray
 */
class Auth extends Entity implements IEntity {
  use ToArray;

  const PASSWORD = 'password';
  const LOCKED_AT = 'locked_at';
  const LOGIN_FAIL_ATTEMPT = 'login_fail_attempt';
  const MIN_LOGIN_ATTEMPT = 0;
  const MAX_LOGIN_ATTEMPT = 3;

  private string $password;
  private ?string $locked_at;
  private int $login_fail_attempt;

  /**
   * @param string $password
   * @param null|string $locked_at
   * @param string|int $login_fail_attempt
   *
   * @throws \App\Exceptions\EntityValidationException
   */
  public function __construct(string $password, ?string $locked_at = null, string|int $login_fail_attempt = 0) {
    $this->password = trim($password);
    if(empty($this->password)) {
      throw new EntityValidationException('validation.required', ['attribute' => self::PASSWORD]);
    }

    $this->locked_at = trim($locked_at);
    if(empty($this->locked_at)) {
      $this->locked_at = null;
    }

    if(!is_null($this->locked_at) && strtotime($this->locked_at) === false) {
      throw new EntityValidationException('validation.date_format', [
        'attribute' => self::LOCKED_AT,
        'format' => 'Y-m-d H:i:s'
      ]);
    }

    $login_fail_attempt = trim($login_fail_attempt);
    if(empty($login_fail_attempt)) {
      $login_fail_attempt = 0;
    }

    if(preg_match(VALIDATION_REGEX_INTEGER, $login_fail_attempt) !== 1) {
      throw new EntityValidationException('validation.regex', ['attribute' => self::LOGIN_FAIL_ATTEMPT]);
    }

    if($login_fail_attempt > self::MAX_LOGIN_ATTEMPT) {
      throw new EntityValidationException('validation.max.numeric', [
        'attribute' => self::LOGIN_FAIL_ATTEMPT,
        'max' => self::MAX_LOGIN_ATTEMPT
      ]);
    }

    $this->login_fail_attempt = $login_fail_attempt;
  }

  /**
   * Return user password (as is)
   *
   * @return string
   */
  public function getPassword() : string {
    return $this->password;
  }

  /**
   * Return when this user is locked
   *
   * @return null|string
   */
  public function getLockedAt() : ?string {
    return $this->locked_at;
  }

  /**
   * Return true if $locked_at is not empty
   *
   * @return bool
   * @see \App\Domain\Entity\Auth::getLockedAt()
   */
  public function isLocked() : bool {
    return !empty(trim($this->locked_at));
  }

  /**
   * Return total fail attempt count
   *
   * @return int
   */
  public function getLoginFailAttempt() : int {
    return $this->login_fail_attempt;
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   */
  public function validatePasswordFormat() : void {
    if(preg_match(VALIDATION_REGEX_PASSWORD, $this->password) !== 1) {
      throw new EntityValidationException('validation.regex', ['attribute' => self::PASSWORD]);
    }
  }
}
