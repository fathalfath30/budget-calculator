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
 * User
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\ToArray
 */
class User extends Entity implements IEntity {
  use ToArray;

  const ID = 'id';
  const USERNAME = 'username';
  const EMAIL = 'email';
  const PASSWORD = 'password';

  private string $id;
  private string $username;
  private string $email;
  private string $password;

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function __construct(array $payload, bool $validate = true) {
    if($validate) {
      $payload = $this->validate($payload,
        [
          self::ID => ['required', 'uuid'],
          self::USERNAME => ['required', 'string', 'min:6']
        ]
      );
    }
  }
}
