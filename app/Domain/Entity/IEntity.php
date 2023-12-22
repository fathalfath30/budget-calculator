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
 * IEntity is the main interface for all entity in
 * this application
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 */
interface IEntity {
  /**
   * Make IEntity from existing data, this method should
   * be used for selecting existing data from database
   * or from user request.
   *
   * @param array $payload
   *
   * @return \App\Domain\Entity\IEntity
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function make(array $payload = []) : IEntity;

  /**
   * Initialize new IEntity class, this method should be used to
   * create new data and also add validation in this method.
   *
   * @param array $payload
   *
   * @return \App\Domain\Entity\IEntity
   * @throws \App\Exceptions\EntityException
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function create(array $payload = []) : IEntity;

  /**
   * Generate array from current entity
   *
   * @return array
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function toArray() : array;
}
