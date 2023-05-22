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
 * Budget
 *
 * This model will handle all budget information and also user
 * budget targets
 *
 * @version 1.0.0
 * @since 1.0.0
 * @see \App\Models\F30_Model
 * @see \Illuminate\Database\Eloquent\Model
 * @author Fathalfath30
 */
class Budget extends F30_Model {
  /** @var string $table set the table name */
  protected $table = 'budgets';
}
