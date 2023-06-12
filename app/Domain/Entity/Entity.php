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

use App\Exceptions\EntityException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Validator;

/**
 * Entity
 *
 * This parent of all entity, it should be used for all entity
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 */
abstract class Entity implements Arrayable {
  /**
   * @throws \Illuminate\Validation\ValidationException|\App\Exceptions\EntityException
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validate(array $payload, array $rules, ?array $message = []) : array {
    $validate = Validator::make($payload, $rules, $message);
    if($validate->fails()) {
      throw new EntityException($validate->errors()->first());
    }

    return $validate->validated();
  }
}
