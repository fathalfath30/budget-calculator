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
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
class Password extends Entity implements IEntity {
  use ToArray;

  /** @var string $password */
  private string $password;

  /** @var null|string $confirm_password */
  private ?string $confirm_password;

  /** @var null|\Carbon\Carbon $password_updated_at */
  private ?Carbon $password_updated_at;

  public const PASSWORD = 'password';
  public const CONFIRM_PASSWORD = 'confirm_password';
  public const PASSWORD_UPDATED_AT = 'password_updated_at';

  /**
   * @param string $password
   * @param null|string $confirm_password
   * @param null|string $password_updated_at
   *
   * @return \App\Domain\Entity\Password
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   * @throws \Carbon\Exceptions\InvalidFormatException
   */
  public static function create(string $password, ?string $confirm_password, ?string $password_updated_at) : Password {
    $validate = (new self)->validate(
      [
        self::PASSWORD => $password,
        self::CONFIRM_PASSWORD => $confirm_password,
        self::PASSWORD_UPDATED_AT => $password_updated_at
      ],
      [
        self::PASSWORD => ['required', 'string', 'min:6'],
        self::CONFIRM_PASSWORD => ['nullable', 'string', 'min:6', ('same:' . self::PASSWORD)],
        self::PASSWORD_UPDATED_AT => ['nullable', 'string', 'date_format:Y-m-d H:i:s']
      ],
      [
        (self::CONFIRM_PASSWORD . ".min") => trans('validation.min.string', [
          'attribute' => self::CONFIRM_PASSWORD, 'min' => '6'
        ]),
        (self::CONFIRM_PASSWORD . ".same") => trans('validation.same', [
          'attribute' => Password::CONFIRM_PASSWORD,
          'other' => Password::PASSWORD
        ]),
        (self::PASSWORD_UPDATED_AT . ".date_format") => trans('validation.date_format', [
          'attribute' => Password::PASSWORD_UPDATED_AT,
          'format' => 'Y-m-d H:i:s'
        ])
      ]
    );

    return self::rebuild($validate[self::PASSWORD], $validate[self::CONFIRM_PASSWORD], $validate[self::PASSWORD_UPDATED_AT]);
  }

  /**
   * @param string $password
   * @param null|string $confirm_password
   * @param null|string $password_updated_at
   *
   * @return \App\Domain\Entity\Password
   * @throws \Carbon\Exceptions\InvalidFormatException
   */
  public static function rebuild(string $password, ?string $confirm_password, ?string $password_updated_at) : Password {
    $cls = new self;
    $cls->password = trim($password);
    if(!empty($confirm_password)) {
      $cls->confirm_password = trim($confirm_password);
    }

    $cls->password_updated_at = Carbon::parse(trim($password_updated_at));
    return $cls;
  }

  /**
   * Return password
   *
   * @return string
   */
  public function getPassword() : string {
    return $this->password;
  }

  /**
   * Return confirm_password
   *
   * @return null|string
   */
  public function getConfirmPassword() : ?string {
    return $this->confirm_password;
  }

  /**
   * Get password_updated_at
   *
   * @return null|\Carbon\Carbon
   */
  public function getPasswordUpdatedAt() : ?Carbon {
    return $this->password_updated_at;
  }

  /**
   * Return encrypted password
   *
   * @return string
   */
  public function encrypt() : string {
    $this->password = Hash::make($this->password);
    return $this->password;
  }

  /**
   * validate the password
   *
   * @param $plain string plain text
   * @param $password  string encrypted text
   *
   * @return bool
   */
  public function validatePassword(string $plain, string $password) : bool {
    return Hash::check($plain, $password);
  }
}
