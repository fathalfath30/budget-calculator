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

  private string $password;
  private ?string $locked_at;
  private int $login_fail_attempt;

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function __construct(array $payload, bool $validate = true) {
    if($validate) {
      $payload = $this->validate($payload,
        [
          self::PASSWORD => ['required', VALIDATION_REGEX_PASSWORD],
          self::LOCKED_AT => ['nullable', VALIDATION_DATE_YMD_HIS],
          self::LOGIN_FAIL_ATTEMPT => ['nullable', 'integer', 'min:0', 'max:5']
        ]
      );
    }

    $this->password = trim($payload[self::PASSWORD]);

    $this->locked_at = null;
    if(isset($payload[self::LOCKED_AT]) && !is_null($payload[self::LOCKED_AT]) && !empty($payload[self::LOCKED_AT])) {
      $this->locked_at = trim($payload[self::LOCKED_AT]);
    }

    $this->login_fail_attempt = 0;
    if(isset($payload[self::LOGIN_FAIL_ATTEMPT]) && $payload[self::LOGIN_FAIL_ATTEMPT] > 0) {
      $this->login_fail_attempt = $payload[self::LOGIN_FAIL_ATTEMPT];
    }
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
   * Return total fail attempt count
   *
   * @return int
   */
  public function getLoginFailAttempt() : int {
    return $this->login_fail_attempt;
  }
}
