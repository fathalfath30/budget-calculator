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
  use HasId;

  public const NAME = 'name';
  public const ENABLE = 'enable';


  public const USER_LEVEL_SUPER_ADMIN = '';
  public const USER_LEVEL_GUEST = '';


  /** @var string $name */
  private string $name;

  /** @var bool $isAdmin */
  private bool $isAdmin;

  /** @var \App\Domain\Entity\Timestamp $timestamp */
  private Timestamp $timestamp;

  /**
   * @param string $id
   * @param string $name
   * @param bool $is_enabled
   * @param \App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Domain\Entity\Role
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function create(string $id, string $name, bool $is_enabled, Timestamp $timestamp) : Role {
    $validate = (new self)->validate(
      [
        self::ID => $id,
        self::NAME => $name,
        self::ENABLE => $is_enabled,
        self::TIMESTAMP => $timestamp
      ],
      [
        self::ID => ['required', 'uuid'],
        self::NAME => ['required'],
        self::ENABLE => ['nullable'],
        self::TIMESTAMP => ['required'],
      ],
      [
        'id.required' => trans('validation.required', ['attribute' => 'id']),
      ]
    );

    return self::rebuild($validate[self::ID], $validate[self::NAME], $validate[self::ENABLE],
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
    $cls->isAdmin = $is_admin;
    $cls->timestamp = $timestamp;

    return $cls;
  }

  /**
   * Get role name
   *
   * @return string
   */
  public function getName() : string {
    return $this->name;
  }

  /**
   * Return true if role is admin
   *
   * @return bool
   */
  public function isAdmin() : bool {
    return $this->isAdmin;
  }

  /**
   * return timestamp
   *
   * @return \App\Domain\Entity\Timestamp
   */
  public function getTimestamp() : Timestamp {
    return $this->timestamp;
  }
}
