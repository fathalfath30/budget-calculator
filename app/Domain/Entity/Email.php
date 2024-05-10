<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\Entity;
use App\Domain\Entity\Traits\ToArray;
use Illuminate\Support\Carbon;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 *
 * @author Fathalfath30
 */
class Email extends Entity implements IEntity {
  use ToArray;

  public const  EMAIL = 'email';
  public const EMAIL_VERIFIED_AT = 'email_verified_at';

  /** @var string $email */
  private string $email;

  /** @var null|\Illuminate\Support\Carbon $email_verified_at */
  private ?Carbon $email_verified_at;

  /**
   * @param string $email
   * @param null|\Illuminate\Support\Carbon $email_verified_at
   *
   * @return self
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function create(string $email, ?Carbon $email_verified_at) : self {
    $payload = (new self)->validate(
      [
        self::EMAIL => $email,
        self::EMAIL_VERIFIED_AT => $email_verified_at
      ],
      [
        self::EMAIL => ['required', 'email'],
        self::EMAIL_VERIFIED_AT => ['nullable']
      ]
    );

    return self::rebuild($payload[self::EMAIL], $payload[self::EMAIL_VERIFIED_AT]);
  }

  /**
   * @param string $email
   * @param null|\Illuminate\Support\Carbon $email_verified_at
   *
   * @return self
   */
  public static function rebuild(string $email, ?Carbon $email_verified_at) : self {
    $cls = new self;
    $cls->email = strtolower(trim($email));
    $cls->email_verified_at = $email_verified_at;

    return $cls;
  }

  /**
   * @return string
   */
  public function getEmail() : string {
    return $this->email;
  }

  /**
   * @return null|\Illuminate\Support\Carbon
   */
  public function getEmailVerifiedAt() : ?Carbon {
    return $this->email_verified_at;
  }
}
