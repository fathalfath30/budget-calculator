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

  public function __construct(array $payload, bool $validate = true) {
    // todo: __construct
  }
}
