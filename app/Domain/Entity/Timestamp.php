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
  private Carbon $createdAt;
  private Carbon $updatedAt;
  private ?Carbon $deletedAt;

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

    $this->createdAt = Carbon::parse($value);
    return $this;
  }

  /**
   * @return \Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getCreatedAt() : Carbon {
    return $this->createdAt;
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

    $this->updatedAt = Carbon::parse($value);
    return $this;
  }

  /**
   * @return \Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getUpdatedAt() : Carbon {
    return $this->updatedAt;
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
      $this->deletedAt = null;
      return $this;
    }

    $this->deletedAt = Carbon::parse($value);
    return $this;
  }

  /**
   * @return null|\Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getDeletedAt() : ?Carbon {
    return $this->deletedAt;
  }

  /**
   * @param string $createdAt
   * @param string $updatedAt
   * @param null|string $deletedAt
   *
   * @return static
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function create(string $createdAt, string $updatedAt, ?string $deletedAt = null) : self {
    $class = new self;

    $class->setCreatedAt($createdAt);
    $class->setUpdatedAt($updatedAt);
    $class->setDeletedAt($deletedAt);

    return $class;
  }
}
