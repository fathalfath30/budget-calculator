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

namespace Tests\TestData;

use App\Domain\Entity\UserProfile;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\UserProfile
 */
trait UserProfileTestData {
  /**
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getSampleFirstname() : string {
    return "Alfath";
  }

  /**
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getSampleLastname() : string {
    return "Dioni";
  }

  /**
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getSampleUsername() : string {
    return "fathalfath30";
  }

  /**
   * @return \App\Domain\Entity\UserProfile
   * @throws \Exception
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getSampleUserProfileEntity() : UserProfile {
    return UserProfile::create($this->getSampleFirstname(), $this->getSampleLastname(), $this->getSampleUsername());
  }
}
