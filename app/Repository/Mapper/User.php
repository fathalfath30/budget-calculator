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
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\Timestamp as TimestampEntity;
use App\Domain\Entity\User as UserEntity;
use App\Domain\Entity\UserInfo as UserInfoEntity;
use App\Repository\Models\User as UserModel;

class User {
  /**
   * @param \App\Repository\Models\User $model
   *
   * @return \App\Domain\Entity\User
   * @throws \App\Exceptions\EntityValidationException
   */
  public static function ModelToEntity(UserModel $model) : UserEntity {
    $role = [];
    if(!empty($model->roles)) {
      for($i = 0; $i < count($model->roles); $i++) {
        $r = $model->roles[$i];
        $role[] = new RoleEntity($r->id, $r->name, $r->level, $r->icon,
          new Timestamp($r->created_at, $r->updated_at, $r->deleted_at));
      }
    }

    return new UserEntity($model->id, $role,
      new AuthEntity($model->password, $model->locked_at, $model->login_fail_attempt),
      new UserInfoEntity($model->first_name, $model->last_name, $model->username, $model->email),
      new TimestampEntity(
        $model->created_at, $model->updated_at, $model->deleted_at
      ));
  }
}
