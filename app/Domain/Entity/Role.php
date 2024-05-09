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
use App\Domain\Entity\Traits\HasId;
use App\Domain\Entity\Traits\HasName;
use App\Domain\Entity\Traits\HasTimestamp;
use App\Domain\Entity\Traits\ToArray;

/**
 * This entity will handle role system
 *
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 * @see \App\Domain\Entity\Traits\ToArray
 * @see \App\Domain\Entity\Traits\HasId
 * @see \App\Domain\Entity\Timestamp
 *
 * @author Fathalfath30
 */
class Role extends Entity implements IEntity {
  use ToArray;
  use HasId, HasName, HasTimestamp;

  public const IS_ADMIN = 'is_admin';


  public const USER_LEVEL_SUPER_ADMIN = '';
  public const USER_LEVEL_GUEST = '';


  /** @var bool $is_admin */
  private bool $is_admin;

  /**
   * @param string $id
   * @param string $name
   * @param bool $is_admin
   * @param \App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Domain\Entity\Role
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function create(string $id, string $name, bool $is_admin, Timestamp $timestamp) : Role {
    $validate = (new self)->validate(
      [
        self::ID => $id,
        self::NAME => $name,
        self::IS_ADMIN => $is_admin,
        self::TIMESTAMP => $timestamp
      ],
      [
        self::ID => ['required', 'uuid'],
        self::NAME => ['required', 'string', 'min:3', 'max:150'],
        self::IS_ADMIN => ['nullable'],
        self::TIMESTAMP => ['required'],
      ]
    );

    return self::rebuild($validate[self::ID], $validate[self::NAME], $validate[self::IS_ADMIN],
      $validate[self::TIMESTAMP]);
  }

  /**
   * @param string $id
   * @param string $name
   * @param bool $is_admin
   * @param \App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Domain\Entity\Role
   */
  public static function rebuild(string $id, string $name, bool $is_admin, Timestamp $timestamp) : Role {
    $cls = new self;

    $cls->id = trim($id);
    $cls->name = trim($name);
    $cls->is_admin = $is_admin;
    $cls->timestamp = $timestamp;

    return $cls;
  }

  /**
   * Return true if role is admin
   *
   * @return bool
   */
  public function is_admin() : bool {
    return $this->is_admin;
  }
}
