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

namespace App\Domain\Repository;

use App\Domain\Entity\User;

/**
 * IUserRepository
 *
 * Repository for handling user data
 *
 * @author fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\User
 */
interface IUserRepository {
  /**
   * Get user data by id
   *
   * @param \App\Domain\Entity\User $payload
   *
   * @return \App\Domain\Entity\User
   * @since 1.0.0
   *
   * @see \App\Domain\Entity\User
   */
  public function Get(User $payload) : User;

  /**
   * Create new user data using user entity
   *
   * @param \App\Domain\Entity\User $payload new user data
   *
   * @return \App\Domain\Entity\User
   * @since 1.0.0
   *
   * @see \App\Domain\Entity\User
   */
  public function Create(User $payload) : User;

  /**
   * Return single user data search by email address, and
   * throw BusinessException if data is not present
   *
   * @param string $email
   *
   * @return \App\Domain\Entity\User
   */
  public function GetByEmail(string $email) : User;
}
