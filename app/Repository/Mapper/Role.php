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

use App\Domain\Entity\Role as RoleEntity;
use App\Domain\Entity\Timestamp as TimestampEntity;
use App\Repository\Models\Role as RoleModel;

class Role {
  /**
   * @param \App\Repository\Models\Role $model
   *
   * @return \App\Domain\Entity\Role
   * @throws \App\Exceptions\EntityValidationException
   */
  public static function fromModelToEntity(RoleModel $model) : RoleEntity {
    return new RoleEntity($model->id, $model->name, $model->level, $model->icon,
      new TimestampEntity($model->created_at, $model->updated_at, $model->deleted_at));
  }
}
