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
use App\Domain\Entity\Traits\HasAuth;
use App\Domain\Entity\Traits\HasRole;
use App\Domain\Entity\Traits\HasTimestamp;
use App\Domain\Entity\Traits\HasUserInfo;
use App\Domain\Entity\Traits\ToArray;

/**
 * User
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\ToArray
 */
class User extends Entity implements IEntity {
  use ToArray, HasRole, HasAuth, HasTimestamp, HasUserInfo;

  const ID = 'id';

  const USER_INFO = 'user_info';

  private string $id;

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function __construct(array $payload, bool $validate = true) {
    if($validate) {
      $payload = $this->validate($payload, [
        self::ID => ['required', 'uuid'],
        self::ROLE => [],
        self::AUTH => []
      ]);

      $role = $payload[self::ROLE] ?? null;
      $this->roleIsRequired($role);
      $this->instanceOfRole($role);

      $auth = $payload[self::AUTH] ?? null;
      $this->authIsRequired($auth);
      $this->instanceOfAuth($auth);
    }
  }
}
