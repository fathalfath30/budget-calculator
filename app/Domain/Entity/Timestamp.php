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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\search;

/**
 * Timestamp
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\ToArray
 * @author Fathalfath30
 */
class Timestamp extends Entity implements IEntity {
  use ToArray;

  public const CREATED_AT = 'created_at';
  public const UPDATED_AT = 'updated_at';
  public const DELETED_AT = 'deleted_at';

  /** @var Carbon|mixed $created_at */
  protected Carbon $created_at;

  /** @var Carbon|mixed $updated_at */
  private Carbon $updated_at;

  /** @var null|Carbon|mixed $deleted_at */
  private ?Carbon $deleted_at;

  /** @var bool $rebuildClass */
  private bool $rebuildClass = false;

  /**
   * This static function should be used when you create new Timestamp entity, if you select from database
   * you can use new
   *
   * @param string $created_at
   * @param string $updated_at
   * @param null|string $deleted_at
   *
   * @return \App\Domain\Entity\Timestamp
   * @throws \Illuminate\Validation\ValidationException
   * @throws \App\Exceptions\EntityValidationException
   */
  public static function create(string $created_at, string $updated_at, ?string $deleted_at = null) : Timestamp {
    $self = new self;
    $validate = $self->validate(
      [
        self::CREATED_AT => $created_at,
        self::UPDATED_AT => $updated_at,
        self::DELETED_AT => $deleted_at
      ],
      [
        self::CREATED_AT => ['required', 'date_format:Y-m-d H:i:s'],
        self::UPDATED_AT => ['required', 'date_format:Y-m-d H:i:s'],
        self::DELETED_AT => ['nullable', 'date_format:Y-m-d H:i:s'],
      ],
      [
        'created_at.required' => trans('validation.required', ['attribute' => 'created_at']),
        'created_at.date_format' => trans('validation.regex', ['attribute' => 'created_at']),
        'updated_at.required' => trans('validation.required', ['attribute' => 'updated_at']),
        'updated_at.date_format' => trans('validation.regex', ['attribute' => 'updated_at']),
        'deleted_at.date_format' => trans('validation.regex', ['attribute' => 'deleted_at']),
      ]
    );

    $self->created_at = Carbon::parse(trim($validate[self::CREATED_AT]));
    $self->updated_at = Carbon::parse(trim($validate[self::DELETED_AT]));
    $self->deleted_at = Carbon::parse(trim($validate[self::DELETED_AT]));

    return $self;
  }

  /**
   * @return \Illuminate\Support\Carbon
   */
  public function getCreatedAt() : Carbon {
    return $this->created_at;
  }

  /**
   * @return \Illuminate\Support\Carbon
   */
  public function getUpdatedAt() : Carbon {
    return $this->updated_at;
  }

  /**
   * @return null|\Illuminate\Support\Carbon
   */
  public function getDeletedAt() : ?Carbon {
    return $this->deleted_at;
  }
}
