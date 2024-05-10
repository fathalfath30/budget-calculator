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
use App\Domain\Entity\Traits\HasId;
use App\Domain\Entity\Traits\HasName;
use App\Domain\Entity\Traits\HasTimestamp;
use App\Domain\Entity\Traits\ToArray;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 * @see \App\Domain\Entity\Traits\ToArray
 * @see \App\Domain\Entity\Traits\HasId
 * @see \App\Domain\Entity\Timestamp
 *
 * @author Fathalfath30
 */
class Group extends Entity implements IEntity {
  use ToArray;
  use HasId, HasName, HasTimestamp;

  public const DESCRIPTION = 'description';

  /** @var null|string $description */
  private ?string $description;

  /**
   * @param string $id
   * @param string $name
   * @param null|string $description
   * @param \App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Domain\Entity\Group
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function create(string $id, string $name, ?string $description, Timestamp $timestamp) : Group {
    $validate = (new self)->validate(
      [
        self::ID => $id,
        self::NAME => $name,
        self::DESCRIPTION => $description,
        self::TIMESTAMP => $timestamp
      ],
      [
        self::ID => ['required', 'uuid'],
        self::NAME => ['required', 'string', 'min:3', 'max:150'],
        self::DESCRIPTION => ['nullable', 'string'],
        self::TIMESTAMP => ['required']
      ]
    );

    return self::rebuild($validate[self::ID], $validate[self::NAME], $validate[self::DESCRIPTION],
      $validate[self::TIMESTAMP]);
  }

  /**
   * @param string $id
   * @param string $name
   * @param null|string $description
   * @param \App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Domain\Entity\Group
   */
  public static function rebuild(string $id, string $name, ?string $description, Timestamp $timestamp) : Group {
    $class = new self;
    $class->id = trim($id);
    $class->name = trim($name);
    if(!empty($description)) {
      $class->description = trim($description);
    }
    $class->timestamp = $timestamp;

    return $class;
  }

  /**
   * @return null|string
   */
  public function getDescription() : ?string {
    return $this->description;
  }
}
