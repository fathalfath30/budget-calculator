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

namespace App\Repository\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This model is used to handle roles management that will be used for
 * user permission
 *
 * @author Fathalfath30
 *
 * @version 1.0.0
 * @since 1.0.0
 * @see \Illuminate\Database\Eloquent\Model
 * @see \App\Repository\Models\F30_Model
 *
 * @property string $id
 * @property string $name
 * @property string $icon
 * @property int $level
 * @property string $created_at
 * @property string $updated_at
 * @property ?string $deleted_at
 */
class Role extends F30_Model {
  use HasFactory, SoftDeletes;

  const ID = 'id';
  const NAME = 'name';
  const ICON = 'icon';
  const LEVEL = 'level';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';

  /** @var string $table set the table name */
  protected $table = 'roles';

  /** @var bool $incrementing disabling AUTO_INCREMENT command, we used UUID */
  public $incrementing = false;

  protected $fillable = ['id', 'name', 'level', 'created_at', 'updated_at', 'deleted_at'];

  /**
   * @return \Illuminate\Database\Eloquent\Factories\Factory
   */
  protected static function newFactory() : Factory {
    return RoleFactory::new();
  }
}
