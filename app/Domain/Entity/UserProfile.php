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
class UserProfile extends Entity implements IEntity {
  use ToArray;

  public const Firstname = 'firstname';
  public const Lastname = 'lastname';
  public const Username = 'username';


  /** @var string $firstname */
  private string $firstname;

  /** @var null|string $lastname */
  private ?string $lastname = null;

  /** @var string $username */
  private string $username;

  /**
   * @param string $firstname
   * @param null|string $lastname
   * @param string $username
   *
   * @return self
   * @throws \Exception
   */
  public static function create(string $firstname, ?string $lastname, string $username) : self {
    $payload = (new self)->validate(
      [
        self::Firstname => $firstname,
        self::Lastname => $lastname,
        self::Username => $username
      ],
      [
        self::Firstname => ['required', 'string', 'min:3', 'max:150', ('regex:' . ValidationRegexStandardName)],
        self::Lastname => ['nullable', 'string', 'min:3', 'max:150', ('regex:' . ValidationRegexStandardName)],
        self::Username => ['required', 'string', 'min:6', 'max:28', ('regex:' . ValidationRegexStandardUsername)],
      ]
    );

    return self::rebuild($payload[self::Firstname], $payload[self::Lastname], $payload[self::Username]);
  }

  /**
   * @param string $firstname
   * @param null|string $lastname
   * @param string $username
   *
   * @return self
   * @throws \Exception
   */
  public static function rebuild(string $firstname, ?string $lastname, string $username) : self {
    $cls = new self;
    $cls->firstname = trim($firstname);
    if(!empty(trim($lastname))) {
      $cls->lastname = trim($lastname);
    }
    $cls->username = trim($username);
    return $cls;
  }

  /**
   * @return string
   */
  public function getFirstname() : string {
    return $this->firstname;
  }

  /**
   * @return null|string
   */
  public function getLastname() : ?string {
    return $this->lastname;
  }

  /**
   * @return string
   */
  public function getUsername() : string {
    return $this->username;
  }
}
