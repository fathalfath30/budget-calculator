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

namespace App\Repository;

use App\Domain\Entity\User as UserEntity;
use App\Domain\Repository\IUserRepository;
use App\Repository\Models\User as UserModel;

class User implements IUserRepository {

  /** @var \App\Repository\Models\User $userModel */
  private UserModel $userModel;

  public function __construct(UserModel $userModel) {
    $this->userModel = $userModel;
  }

  /**
   * @inheritDoc
   */
  public function Get(string $userId) : UserEntity {
    // TODO: Implement Get() method.
  }

  /**
   * @inheritDoc
   */
  public function Create(UserEntity $payload) : UserEntity {
    // TODO: Implement Create() method.
  }
}
