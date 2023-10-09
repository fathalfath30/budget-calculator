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
use App\Domain\Entity\Traits\EntityValidation;
use App\Domain\Entity\Traits\ToArray;

/**
 * UserInfo
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\ToArray
 */
class UserInfo extends Entity implements IEntity {
  use ToArray, EntityValidation;

  const FIRST_NAME = 'first_name';
  const LAST_NAME = 'last_name';
  const USERNAME = 'username';
  const EMAIL = 'email';

  private string $first_name;
  private ?string $last_name;
  private string $username;
  private string $email;

  /**
   * @param string $first_name
   * @param null|string $last_name
   * @param string $username
   * @param string $email
   *
   * @throws \App\Exceptions\EntityValidationException
   */
  public function __construct(string $first_name, ?string $last_name, string $username, string $email) {
    $this->first_name = $this->validateGeneralName($first_name, self::FIRST_NAME);
    $this->last_name = $this->validateGeneralName($last_name, self::LAST_NAME, true);
    $this->username = $this->validateUsername($username);
    $this->email = $this->validateEmail($email);
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
