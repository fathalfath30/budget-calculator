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

namespace App\Repository\Mapper;

use App\Domain\Entity\Auth as AuthEntity;
use App\Domain\Entity\Role as RoleEntity;
use App\Domain\Entity\Timestamp as TimestampEntity;
use App\Domain\Entity\User as UserEntity;
use App\Domain\Entity\UserInfo as UserInfoEntity;
use App\Repository\Models\User as UserModel;

class User {
  /**
   * @param \App\Repository\Models\User $user
   *
   * @return \App\Domain\Entity\User
   * @throws \App\Exceptions\EntityValidationException
   */
  public static function ModelToEntity(UserModel $user) : UserEntity {
    $role = new RoleEntity;
    $auth = new AuthEntity;
    $userInfo = new UserInfoEntity($user->first_name, $user->last_name, $user->username, $user->email);
    $timestamp = new TimestampEntity;

    return new UserEntity($user->id, $role, $auth, $userInfo, $timestamp);
  }
}
