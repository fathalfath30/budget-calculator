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


namespace App\Traits;

use App\Domain\Entity\IStandardEntity;
use App\Domain\Entity\Timestamp;
use App\Exceptions\EntityException;
use Exception;
use Ramsey\Uuid\Uuid;

trait StandardEntity {
  /** @var string id */
  private string $id;

  /** @var string $name */
  private string $name;

  /** @var null|\App\Domain\Entity\Timestamp $timestamp */
  private ?Timestamp $timestamp;

  /**
   * this method will return entity id
   *
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getId() : string {
    return $this->id;
  }

  /**
   * @param string $value
   *
   * @return \App\Domain\Entity\Role|\App\Traits\StandardEntity
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setId(string $value) : self {
    $value = trim($value);
    if(empty($value)) {
      throw new EntityException("entity.id.required");
    }

    if(!Uuid::isValid($value)) {
      throw new EntityException("entity.id.invalid");
    }

    $this->id = $value;
    return $this;
  }

  /**
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getName() : string {
    return $this->name;
  }

  /**
   * @param string $value
   *
   * @return \App\Domain\Entity\IStandardEntity
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setName(string $value) : IStandardEntity {
    $value = trim($value);
    if(empty($value)) {
      throw new EntityException("entity.name.required");
    }

    $this->name = $value;
    return $this;
  }

  /**
   * @return null|\App\Domain\Entity\Timestamp
   */
  public function getTimestamp() : Timestamp {
    return $this->timestamp;
  }

  /**
   * @param null|\App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Traits\StandardEntity|\App\Domain\Entity\Role
   */
  public function setTimestamp(?Timestamp $timestamp) : self {
    $this->timestamp = $timestamp;
    return $this;
  }
}
