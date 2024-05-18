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
use App\Domain\Entity\Traits\HasId;
use App\Domain\Entity\Traits\ToArray;
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
class User extends Entity implements IEntity {
  use HasId, ToArray;

  public const UserProfile = 'user_profile';
  public const Email = 'email';
  public const Auth = 'auth';
  public const LockedAt = 'locked_at';
  public const Timestamp = 'timestamp';

  /** @var \App\Domain\Entity\UserProfile $profile */
  private UserProfile $profile;

  /** @var \App\Domain\Entity\Email $email */
  private Email $email;

  /** @var \App\Domain\Entity\Auth $auth */
  private Auth $auth;

  /** @var null|\Illuminate\Support\Carbon $locked_at */
  private ?Carbon $locked_at;

  /** @var \App\Domain\Entity\Timestamp $timestamp */
  private Timestamp $timestamp;

  /**
   * @param \App\Domain\Entity\UserProfile $profile
   * @param \App\Domain\Entity\Email $email
   * @param \App\Domain\Entity\Auth $auth
   *
   * @return \App\Domain\Entity\User
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function create(UserProfile $profile, Email $email, Auth $auth) : User {
    $now = date('Y-m-d H:i:s');
    return self::rebuild($profile, $email, $auth, null, Timestamp::create($now, $now));
  }

  /**
   * @param \App\Domain\Entity\UserProfile $profile
   * @param \App\Domain\Entity\Email $email
   * @param \App\Domain\Entity\Auth $auth
   * @param null|\Illuminate\Support\Carbon $locked_at
   * @param \App\Domain\Entity\Timestamp $timestamp
   *
   * @return \App\Domain\Entity\User
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function rebuild(UserProfile $profile, Email $email, Auth $auth, ?Carbon $locked_at,
    Timestamp $timestamp) : User {
    $self = new self;

    $self->profile = $profile;
    $self->email = $email;
    $self->auth = $auth;
    $self->locked_at = $locked_at;
    $self->timestamp = $timestamp;

    return $self;
  }

  /**
   * @return \App\Domain\Entity\UserProfile
   */
  public function getProfile() : UserProfile {
    return $this->profile;
  }

  /**
   * @return \App\Domain\Entity\Email
   */
  public function getEmail() : Email {
    return $this->email;
  }

  /**
   * @return \App\Domain\Entity\Auth
   */
  public function getAuth() : Auth {
    return $this->auth;
  }

  /**
   * @return null|\Illuminate\Support\Carbon
   */
  public function getLockedAt() : ?Carbon {
    return $this->locked_at;
  }

  public function isLocked() : bool {
    return !empty($this->locked_at);
  }

  /**
   * @return \App\Domain\Entity\Timestamp
   */
  public function getTimestamp() : Timestamp {
    return $this->timestamp;
  }
}
