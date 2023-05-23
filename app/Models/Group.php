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
/**
 * Group
 *
 * This model will handle all accounts group and custom account groups, in case
 * users want to add their own or change existing group name.
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 * @see \Illuminate\Database\Eloquent\Model
 * @see \App\Models\F30_Model
 */
class Group extends F30_Model {
  /** @var string $table set the table name */
  protected $table = 'groups';

  /** @var bool $incrementing disabling AUTO_INCREMENT command, we used UUID */
  public $incrementing = false;
}
