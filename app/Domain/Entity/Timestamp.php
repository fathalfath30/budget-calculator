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

/**
 * Timestamp
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\ToArray
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
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function __construct(array $payload, bool $validate = true) {
    if($validate) {
      $payload = $this->validate($payload,
        [
          self::CREATED_AT => ['required', 'date:Y-m-d H:i:s'],
          self::UPDATED_AT => ['required', 'date:Y-m-d H:i:s'],
          self::DELETED_AT => ['nullable', 'date:Y-m-d H:i:s'],
        ]
      );
    }

    $this->created_at = $payload[self::CREATED_AT];
    $this->updated_at = $payload[self::UPDATED_AT];
    $this->deleted_at = $payload[self::DELETED_AT] ?? null;
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
