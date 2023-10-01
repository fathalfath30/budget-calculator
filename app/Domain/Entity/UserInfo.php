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
 * UserInfo
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\ToArray
 */
class UserInfo extends Entity implements IEntity {
  use ToArray;

  const FIRST_NAME = 'first_name';
  const LAST_NAME = 'last_name';
  const USERNAME = 'username';
  const EMAIL = 'email';

  private string $first_name;
  private ?string $last_name;
  private string $username;
  private string $email;

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function __construct(array $payload, bool $validate = true) {
    if($validate) {
      $payload = $this->validate($payload,
        [
          self::FIRST_NAME => ['required', VALIDATION_REGEX_STD_NAME],
          self::LAST_NAME => ['nullable', VALIDATION_REGEX_STD_NAME],
          self::USERNAME => ['required', VALIDATION_REGEX_USERNAME],
          self::EMAIL => ['nullable', 'email', 'max:255'],
        ]
      );
    }

    $this->first_name = trim($payload[self::FIRST_NAME]);
    $this->last_name = null;
    if(!empty($payload[self::LAST_NAME])) {
      $this->last_name = trim($payload[self::LAST_NAME]);
    }
    $this->username = trim($payload[self::USERNAME]);
    $this->email = strtolower(trim($payload[self::EMAIL]));
  }

  /**
   * Return user first name
   *
   * @return string first name
   */
  public function getFirstName() : string {
    return $this->first_name;
  }

  /**
   * Return user last name if it has value otherwise it will return null if empty
   *
   * @return null|string first name
   */
  public function getLastName() : ?string {
    if(empty(trim($this->last_name))) {
      return null;
    }

    return $this->last_name;
  }

  /**
   * Return user username
   *
   * @return string username
   */
  public function getUsername() : string {
    return $this->username;
  }

  /**
   * Return user email (lower case)
   *
   * @return string
   */
  public function getEmail() : string {
    return $this->email;
  }
}
