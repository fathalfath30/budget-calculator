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
use App\Domain\Entity\Traits\HasAuth;
use App\Domain\Entity\Traits\HasRole;
use App\Domain\Entity\Traits\HasTimestamp;
use App\Domain\Entity\Traits\HasUserInfo;
use App\Domain\Entity\Traits\ToArray;
use App\Exceptions\EntityValidationException;

/**
 * User
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\ToArray
 */
class User extends Entity implements IEntity {
  use ToArray, HasRole, HasAuth, HasTimestamp, HasUserInfo;

  private string $id;

  /**
   * @param string $id
   * @param \App\Domain\Entity\Role $role
   * @param \App\Domain\Entity\Auth $auth
   * @param \App\Domain\Entity\UserInfo $userInfo
   * @param null|\App\Domain\Entity\Timestamp $timestamp
   *
   * @throws \App\Exceptions\EntityValidationException
   */
  public function __construct(string $id, Role $role, Auth $auth, UserInfo $userInfo, ?Timestamp $timestamp) {
    $this->id = trim($id);
    if(empty($this->id)) {
      throw new EntityValidationException('validation.required', ['attribute' => 'id']);
    }

    $this->role = $role;
    $this->auth = $auth;
    $this->user_info = $userInfo;
    $this->timestamp = $timestamp;
  }
}
