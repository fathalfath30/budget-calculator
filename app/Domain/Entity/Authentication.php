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

use App\Exceptions\EntityException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class for user authentication
 *
 * @version 1.0.0
 * @since 0.1.0-alpha
 *
 * @see \Illuminate\Support\Carbon
 * @see \App\Domain\Entity\Role
 *
 * @author Fathalfath30
 */
class Authentication {
  /** @var string $password */
  private string $password;

  /** @var null|\Illuminate\Support\Carbon $passwordUpdatedAt */
  private ?Carbon $passwordUpdatedAt;

  /** @var \App\Domain\Entity\Role $role */
  private Role $role;

  /** @var null|string $rememberToken */
  private ?string $rememberToken;

  /** @var int */
  const MINIMUM_PASSWORD_LENGTH = 6;

  /**
   * @param bool $encrypt
   *
   * @return string
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getPassword(bool $encrypt = false) : string {
    if($encrypt) {
      return Hash::make($this->password);
    }

    return $this->password;
  }

  /**
   * @param string $value
   *
   * @return $this
   * @throws \App\Exceptions\EntityException
   * @version 1.0.0
   * @since 1.0.0
   */
  protected function setPassword(string $value) : self {
    $value = trim($value);
    if(empty($value)) {
      throw new EntityException("entity.password.required");
    }

    if(strlen($value) < self::MINIMUM_PASSWORD_LENGTH) {
      throw new EntityException("entity.password.min");
    }

    $this->password = $value;

    return $this;
  }

  /**
   * @return null|\Illuminate\Support\Carbon
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getValidPasswordUpdatedAt() : ?Carbon {
    return $this->passwordUpdatedAt;
  }

  /**
   * @param null|string $value
   *
   * @return $this
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setPasswordUpdatedAt(?string $value) : self {
    if(empty($value)) {
      $this->passwordUpdatedAt = null;
      return $this;
    }

    $this->passwordUpdatedAt = Carbon::parse($value);
    return $this;
  }

  /**
   * @return \App\Domain\Entity\Role
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getRole() : Role {
    return $this->role;
  }

  /**
   * @param \App\Domain\Entity\Role $role
   *
   * @return $this
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setRole(Role $role) : self {
    $this->role = $role;
    return $this;
  }

  /**
   * @return null|string
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getRememberToken() : ?string {
    return $this->rememberToken;
  }

  /**
   * @param null|string $rememberToken
   *
   * @return $this
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setRememberToken(?string $rememberToken) : self {
    $this->rememberToken = $rememberToken;
    return $this;
  }

  /**
   * @param string $password
   *
   * @return bool
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function isAuthorized(string $password) : bool {
    return Hash::check($this->getPassword(), $password);
  }

  /**
   * @param string $password
   * @param \App\Domain\Entity\Role $role
   * @param null|string $passwordUpdatedAt
   * @param null|string $rememberToken
   *
   * @return \App\Domain\Entity\Authentication
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function create(string $password, Role $role, ?string $passwordUpdatedAt = null,
    ?string $rememberToken = null) : Authentication {
    $class = new self;

    $class->setPassword($password);
    $class->setPasswordUpdatedAt($passwordUpdatedAt);
    $class->setRole($role);
    $class->setRememberToken($rememberToken);

    return $class;
  }
}
