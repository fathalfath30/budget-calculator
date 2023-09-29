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

/**
 * Role
 *
 * This class will handle role entity, should be used to handle security.
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\ToArray
 */
class Role extends Entity implements IEntity {
  use ToArray;

  const ID = 'id';
  const NAME = 'name';
  const LEVEL = 'level';

  const USER_LEVEL_SUPER_ADMIN = 999;
  const USER_LEVEL_GUEST = 0;

  private string $id;
  private string $name;
  private int $level;
  private ?Timestamp $timestamp = null;

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function __construct(array $payload, bool $validate = true) {
    if($validate) {
      $payload = $this->validate($payload,
        [
          self::ID => ['required', 'uuid'],
          self::NAME => ['required', 'regex:/^[\pL\s\-]+$/u'],
          self::LEVEL => ['nullable', 'integer', 'min:1', 'max:998'],
          self::TIMESTAMP => ['nullable']
        ]
      );

      $this->validateTimestamp($payload);
    }

    $this->id = trim($payload[self::ID]);
    $this->name = trim($payload[self::NAME]);
    $this->level = $payload[self::LEVEL] ?? self::USER_LEVEL_GUEST;
    $this->timestamp = $payload[self::TIMESTAMP];
  }

  /**
   * Return valid user id
   *
   * @return string user id
   */
  public function getId() : string {
    return $this->id;
  }

  /**
   * Return valid role name
   *
   * @return string role name
   */
  public function getName() : string {
    return $this->name;
  }

  /**
   * Return valid user level in integer format.
   *
   * @return int level
   */
  public function getLevel() : int {
    return $this->level;
  }

  /**
   * return role timestamp if set, otherwise it will return null as default.
   *
   * @return null|\App\Domain\Entity\Timestamp
   */
  public function getTimestamp() : ?Timestamp {
    return $this->timestamp;
  }

  /**
   * it will return true if user level is 999 otherwise it will return false
   *
   * @return bool
   */
  public function isSuperAdmin() : bool {
    return $this->level == self::USER_LEVEL_SUPER_ADMIN;
  }

  /**
   * it will return true if user level is 0 otherwise it will return false
   *
   * @return bool
   */
  public function isGuest() : bool {
    return $this->level == self::USER_LEVEL_GUEST;
  }

  /**
   * Set level to 999 (default super admin level)
   *
   * @return $this role entity
   */
  public function setSuperAdmin() : Role {
    $this->level = self::USER_LEVEL_SUPER_ADMIN;
    return $this;
  }


  /**
   * Set level to 0 (default guest level)
   *
   * @return $this
   */
  public function setGuest() : Role {
    $this->level = self::USER_LEVEL_GUEST;
    return $this;
  }
}
