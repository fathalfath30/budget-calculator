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
use Illuminate\Support\Carbon;

/**
 * Timestamp entity will tell you when some data is created, updated and
 * deleted
 *
 * @version 1.0.0
 * @since 0.1.0-alpha
 *
 * @see \Illuminate\Support\Carbon
 * @author Fathalfath30
 */
class Timestamp {
  private Carbon $created_at;
  private Carbon $updated_at;
  private ?Carbon $deleted_at;

  /**
   * @param string $value
   *
   * @return $this
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setCreatedAt(string $value) : self {
    if(empty($value)) {
      throw new EntityException("entity.created_at.required");
    }

    $this->created_at = Carbon::parse($value);
    return $this;
  }

  /**
   * @return \Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getCreatedAt() : Carbon {
    return $this->created_at;
  }

  /**
   * @param string $value
   *
   * @return $this
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setUpdatedAt(string $value) : self {
    if(empty($value)) {
      throw new EntityException("entity.updated_at.required");
    }

    $this->updated_at = Carbon::parse($value);
    return $this;
  }

  /**
   * @return \Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getUpdatedAt() : Carbon {
    return $this->updated_at;
  }

  /**
   * @param null|string $value
   *
   * @return $this
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setDeletedAt(?string $value) : self {
    if(empty($value)) {
      $this->deleted_at = null;
      return $this;
    }

    $this->deleted_at = Carbon::parse($value);
    return $this;
  }

  /**
   * @return null|\Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getDeletedAt() : ?Carbon {
    return $this->deleted_at;
  }

  /**
   * @param string $created_at
   * @param string $updated_at
   * @param null|string $deleted_at
   *
   * @return static
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function create(string $created_at, string $updated_at, ?string $deleted_at = null) : self {
    $class = new self;

    $class->setCreatedAt($created_at);
    $class->setUpdatedAt($updated_at);
    $class->setDeletedAt($deleted_at);

    return $class;
  }
}
