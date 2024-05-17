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

  public const Password = 'password';
  public const ConfirmPassword = 'confirm_password';
  public const PasswordUpdatedAt = 'password_updated_at';
  public const FailAttempt = 'fail_attempt';

  /** @var string $password */
  private string $password;

  /** @var null|string $confirm_password */
  private ?string $confirm_password;

  /** @var null|\Carbon\Carbon $updated_at */
  private ?Carbon $updated_at;

  /** @var int $fail_attempt */
  private int $fail_attempt = 0;

  /**
   * @param string $password
   * @param null|string $confirm_password
   * @param null|string $password_updated_at
   * @param int $fail_attempt
   *
   * @return \App\Domain\Entity\Password
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function create(string $password, ?string $confirm_password, ?string $password_updated_at,
    int $fail_attempt = 0) : Password {
    $validate = (new self)->validate(
      [
        self::Password => $password,
        self::ConfirmPassword => $confirm_password,
        self::PasswordUpdatedAt => $password_updated_at,
        self::FailAttempt => $fail_attempt
      ],
      [
        self::Password => ['required', 'string', 'min:6'],
        self::ConfirmPassword => ['nullable', 'string', 'min:6', ('same:' . self::Password)],
        self::PasswordUpdatedAt => ['nullable', 'string', 'date_format:Y-m-d H:i:s'],
        self::FailAttempt => ['required', 'numeric', 'min:0', 'max:3']
      ],
      [
        (self::ConfirmPassword . ".min") => trans('validation.min.string', [
          'attribute' => self::ConfirmPassword, 'min' => '6'
        ]),
        (self::ConfirmPassword . ".same") => trans('validation.same', [
          'attribute' => Password::ConfirmPassword,
          'other' => Password::Password
        ]),
        (self::PasswordUpdatedAt . ".date_format") => trans('validation.date_format', [
          'attribute' => Password::PasswordUpdatedAt,
          'format' => 'Y-m-d H:i:s'
        ])
      ]
    );

    return self::rebuild($validate[self::Password], $validate[self::ConfirmPassword], $validate[self::PasswordUpdatedAt]);
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

    $cls->updated_at = Carbon::parse(trim($password_updated_at));
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
  public function getUpdatedAt() : ?Carbon {
    return $this->updated_at;
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
