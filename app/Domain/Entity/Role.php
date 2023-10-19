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
use App\Domain\Entity\Traits\EntityValidation;
use App\Domain\Entity\Traits\ToArray;
use App\Exceptions\EntityValidationException;

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
 * @see \App\Domain\Entity\Traits\ToArray
 * @see \App\Domain\Entity\Traits\EntityValidation
 */
class Role extends Entity implements IEntity {
  use ToArray, EntityValidation;

  const ID = 'id';
  const NAME = 'name';
  const ICON = 'icon';
  const LEVEL = 'level';

  const USER_LEVEL_SUPER_ADMIN = 999;
  const USER_LEVEL_GUEST = 0;

  private string $id;
  private string $name;
  private int $level;
  private ?string $icon;
  private ?Timestamp $timestamp = null;

  /**
   * @param string $id
   * @param string $name
   * @param int|string $level
   * @param null|string $icon
   * @param null|\App\Domain\Entity\Timestamp $timestamp
   *
   * @throws \App\Exceptions\EntityValidationException
   */
  public function __construct(string $id, string $name, int|string $level, ?string $icon, ?Timestamp $timestamp = null) {
    $this->id = $this->validateId($id);
    $this->name = $this->validateGeneralName($name);

    $level = trim($level);
    if(empty($level)) {
      $level = self::USER_LEVEL_GUEST;
    }

    if(preg_match(VALIDATION_REGEX_INTEGER, $level) !== 1) {
      throw new EntityValidationException('validation.integer', [
        'attribute' => 'level'
      ]);
    }

    $this->level = $level;
    if(!empty($icon)) {
      $this->icon = trim($icon);
    }
    $this->timestamp = $timestamp;
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
   * @return null|string
   */
  public function getIcon() : ?string {
    return $this->icon;
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
