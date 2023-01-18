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
 * IStandardEntity is interface to standardization some entity
 * because it required id, name and may required timestamp too.
 *
 * @version 1.0.0
 * @since 0.1.0-alpha
 *
 * @author Fathalfath30
 */
interface IStandardEntity
{
  /**
   * Get Id
   *
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getId() : string;

  /**
   * @param string $value
   *
   * @return $this
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setId(string $value) : self;

  /*
   * Get name from entity
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getName() : string;

  /**
   * @param string $value
   *
   * @return $this
   * @throws \App\Exceptions\EntityException
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setName(string $value) : self;

  /**
   * @return \App\Domain\Entity\Timestamp
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getTimestamp() : Timestamp;

  /**
   * @param \App\Domain\Entity\Timestamp $value
   *
   * @return $this
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function setTimestamp(Timestamp $value) : self;
}
