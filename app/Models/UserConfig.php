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


namespace App\Models;

use App\Domain\Model\IF30Model;
use Illuminate\Database\Eloquent\Model;

/**
 * UserConfig Model
 *
 * @version 1.0.0
 * @since 0.1.0
 * @see \App\Models\User
 * @see \App\Models\Configuration
 *
 * @author Fathalfath30
 *
 * @property string id
 * @property string user_id
 * @property string configuration_id
 * @property ?string user_value
 * @property string created_at
 * @property string updated_at
 */
class UserConfig extends Model implements IF30Model
{
  protected $table = 'user_config';
  protected $primaryKey = 'id';

  public $incrementing = false;
}
