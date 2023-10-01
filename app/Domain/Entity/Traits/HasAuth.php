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

namespace App\Domain\Entity\Traits;

use App\Domain\Entity\Auth;
use App\Domain\Entity\Role;
use App\Exceptions\EntityException;

/**
 * HasAuth
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Auth
 */
trait HasAuth {
  const AUTH = 'auth';

  /** @var \App\Domain\Entity\Auth $auth */
  private Auth $auth;

  /**
   * @param $value
   *
   * @return void
   * @throws \App\Exceptions\EntityException
   */
  public function authIsRequired($value) : void {
    if(empty($value)) {
      throw new EntityException(
        trans('validation.required', ['attribute' => 'auth'])
      );
    }
  }

  /**
   * @param mixed $object
   *
   * @return void
   * @throws \App\Exceptions\EntityException
   */
  public function instanceOfAuth(mixed $object) : void {
    if(!($object instanceof Role)) {
      throw new EntityException(
        trans("validation.instance_of", ['attribute' => 'auth', 'values' => Auth::class])
      );
    }
  }
}
