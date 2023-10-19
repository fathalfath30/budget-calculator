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

use App\Domain\Entity\Traits\Entity;
use App\Domain\Entity\Traits\ToArray;
use App\Exceptions\EntityValidationException;

/**
 * Timestamp
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\ToArray
 */
class Timestamp extends Entity implements IEntity {
  use ToArray;

  public const CREATED_AT = 'created_at';
  public const UPDATED_AT = 'updated_at';
  public const DELETED_AT = 'deleted_at';

  /** @var string|mixed $created_at */
  public string $created_at;

  /** @var string|mixed $updated_at */
  private string $updated_at;

  /** @var null|string|mixed $deleted_at */
  private ?string $deleted_at;

  /** @var bool $rebuildClass */
  private bool $rebuildClass = false;

  /**
   * @param string $created_at
   * @param string $updated_at
   * @param null|string $deleted_at
   *
   * @throws \App\Exceptions\EntityValidationException
   */
  public function __construct(string $created_at, string $updated_at, ?string $deleted_at = null) {
    $this->created_at = trim($created_at);
    if(empty($this->created_at)) {
      throw new EntityValidationException("validation.required", ['attribute' => 'created_at']);
    }

    if(preg_match(VALIDATION_REGEX_DATETIME_YMD_HIS, $this->created_at) !== 1) {
      throw new EntityValidationException("validation.regex", ['attribute' => 'created_at']);
    }

    $this->updated_at = trim($updated_at);
    if(empty($this->updated_at)) {
      throw new EntityValidationException("validation.required", ['attribute' => 'updated_at']);
    }

    if(preg_match(VALIDATION_REGEX_DATETIME_YMD_HIS, $this->updated_at) !== 1) {
      throw new EntityValidationException("validation.regex", ['attribute' => 'updated_at']);
    }

    if(!empty($deleted_at)) {
      $this->deleted_at = $deleted_at;
      if(preg_match(VALIDATION_REGEX_DATETIME_YMD_HIS, $this->deleted_at) !== 1) {
        throw new EntityValidationException("validation.regex", ['attribute' => 'deleted_at']);
      }
    }
  }

  /**
   * @return string
   */
  public function getCreatedAt() : string {
    return $this->created_at;
  }

  /**
   * @return string
   */
  public function getUpdatedAt() : string {
    return $this->updated_at;
  }

  /**
   * @return null|string
   */
  public function getDeletedAt() : ?string {
    return $this->deleted_at;
  }
}
