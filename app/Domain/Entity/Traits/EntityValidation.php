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
   * @param null|string $value
   * @param string $attribute
   * @param bool $allow_empty
   * @param bool $defaultNull
   *
   * @return null|string
   * @throws \App\Exceptions\EntityValidationException
   */
  protected function validateGeneralName(?string $value, string $attribute = 'name', bool $allow_empty = false, bool $defaultNull = true) : ?string {
    $value = trim($value);
    if($allow_empty && empty($value)) {
      return $defaultNull ? null : "";
    }

    if(empty($value)) {
      throw new EntityValidationException('validation.required', ['attribute' => $attribute]);
    }

    if(preg_match(VALIDATION_REGEX_STD_NAME, $value) !== 1) {
      throw new EntityValidationException('validation.regex', ['attribute' => $attribute]);
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
  protected function validateUsername(string $value, string $attribute = 'username') : string {
    $value = trim($value);
    if(empty($value)) {
      throw new EntityValidationException('validation.required', ['attribute' => $attribute]);
    }

    if(preg_match(VALIDATION_REGEX_USERNAME, $value) !== 1) {
      throw new EntityValidationException("validation.regex", ["attribute" => $attribute]);
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
  protected function validateEmail(string $value, string $attribute = 'email') : string {
    $value = trim($value);
    if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      throw new EntityValidationException("validation.email", ["attribute" => $attribute]);
    }

    return strtolower($value);
  }
}
