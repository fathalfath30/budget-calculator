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

  public const created_at = 'created_at';
  public const updated_at = 'updated_at';
  public const deleted_at = 'deleted_at';

  /** @var string|mixed $created_at */
  public string $created_at;

  /** @var string|mixed $updated_at */
  private string $updated_at;

  /** @var null|string|mixed $deleted_at */
  private ?string $deleted_at;

  public static function make(array $payload = []) : Timestamp {
    $self = new self;
    $self->created_at = trim($payload[self::created_at]);
    $self->updated_at = trim($payload[self::updated_at]);
    $self->deleted_at = trim($payload[self::deleted_at]);
    if(empty($self->deleted_at)) {
      $self->deleted_at = null;
    }

    return $self;
  }

  /** @inheritDoc */
  public static function create(array $payload = []) : IEntity {
    return self::make((new self)->validate($payload,
      [
        self::created_at => ['required', 'date_format:Y-m-d H:i:s'],
        self::updated_at => ['required', 'date_format:Y-m-d H:i:s'],
        self::deleted_at => ['nullable', 'date_format:Y-m-d H:i:s']
      ],
      [
        self::created_at => [
          'required' => trans('validation.required', [
            'attribute' => self::created_at
          ]),
          'date_format' => trans('validation.date_format', [
            'attribute' => self::created_at,
            'format' => 'Y-m-d H:i:s'
          ])
        ],
        self::updated_at => [
          'required' => trans('validation.required', [
            'attribute' => self::updated_at
          ]),
          'date_format' => trans('validation.date_format', [
            'attribute' => self::updated_at,
            'format' => 'Y-m-d H:i:s'
          ])
        ],
        self::deleted_at => [
          'date_format' => trans('validation.date_format', [
            'attribute' => self::deleted_at,
            'format' => 'Y-m-d H:i:s'
          ])
        ]
      ]
    ));
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
