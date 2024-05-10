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
use Exception;
use Illuminate\Support\Carbon;

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

  public const FIRSTNAME = 'firstname';
  public const LASTNAME = 'lastname';
  public const USERNAME = 'username';
  public const EMAIL = 'email';
  public const AUTH = 'auth';


  /** @var string $firstname */
  private string $firstname;

  /** @var null|string $lastname */
  private ?string $lastname;

  /** @var string $username */
  private string $username;

  /** @var string $email */
  private string $email;

  /** @var \App\Domain\Entity\Auth $auth */
  private Auth $auth;

  /** @var \App\Domain\Entity\Timestamp $timestamp */
  private Timestamp $timestamp;

  public static function create(string $firstname, ?string $lastname, string $username, string $email, Auth $auth,
    Timestamp $timestamp) : self {
    throw new Exception("not implemented");
  }

  public static function rebuild(string $firstname, ?string $lastname, string $username, string $email, Auth $auth,
    Timestamp $timestamp) : self {
    throw new Exception("not implemented");
  }
}
