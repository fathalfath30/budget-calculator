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

use App\Exceptions\EntityValidationException;

trait EntityValidation {
  /**
   * @param string $value
   * @param string $attribute
   *
   * @return string
   * @throws \App\Exceptions\EntityValidationException
   */
  protected function validateId(string $value, string $attribute = 'id') : string {
    $value = trim($value);
    if(empty($value)) {
      throw new EntityValidationException('validation.required', ['attribute' => $attribute]);
    }

    if(preg_match("/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i", $value) !== 1) {
      throw new EntityValidationException('validation.uuid', ['attribute' => 'id']);
    }

    return $value;
  }

  /**
   * @param string $value
   * @param string $attribute
   *
   * @return string
   * @throws \App\Exceptions\EntityValidationException
   */
  protected function generalName(string $value, string $attribute = 'name') : string {
    $value = trim($value);
    if(empty($value)) {
      throw new EntityValidationException('validation.required', ['attribute' => $attribute]);
    }

    if(preg_match("/^[\pL\s\-]+$/u", $value) !== 1) {
      throw new EntityValidationException('validation.regex', ['attribute' => $attribute]);
    }

    return $value;
  }
}
