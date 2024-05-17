<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\Entity;
use App\Domain\Entity\Traits\ToArray;
use Carbon\Carbon;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 * @see \App\Domain\Entity\Traits\ToArray
 *
 * @author Fathalfath30
 */
class Pin extends Entity implements IEntity {
  use ToArray;

  public const Pin = 'pin';
  public const LastUpdated = 'pin_last_updated';
  public const FailAttempt = 'fail_attempt';

  /** @var string $pin */
  private string $pin;

  /** @var \Carbon\Carbon $last_updated */
  private Carbon $last_updated;

  /** @var int $fail_attempt */
  private int $fail_attempt = 0;

  /**
   * @param string $pin
   * @param \Carbon\Carbon $lastUpdated
   *
   * @return \App\Domain\Entity\Pin
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */

  public static function create(string $pin, Carbon $lastUpdated) : Pin {
    $payload = (new self)->validate(
      [
        self::Pin => trim($pin),
        self::LastUpdated => $lastUpdated
      ],
      [
        self::Pin => ['required', 'numeric', 'digits:6'],
        self::LastUpdated => ['required']
      ]
    );

    // rebuild the payload
    return self::rebuild($payload[self::Pin], $payload[self::LastUpdated]);
  }

  /**
   * @param string $pin
   * @param \Carbon\Carbon $lastUpdated
   *
   * @return \App\Domain\Entity\Pin
   */
  public static function rebuild(string $pin, Carbon $lastUpdated) : Pin {
    $cls = new self;

    $cls->pin = trim($pin);
    $cls->last_updated = $lastUpdated;

    return $cls;
  }

  /**
   * @return string
   */
  public function getPin() : string {
    return $this->pin;
  }

  /**
   * @return \Carbon\Carbon
   */
  public function getLastUpdated() : Carbon {
    return $this->last_updated;
  }
}
