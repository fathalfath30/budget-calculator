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

/**
 * GroupTestData
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @see \Tests\TestData\TimestampTestData
 * @author Fathalfath30
 */
trait GroupTestData {
  use TimestampTestData;

  /**
   * Return sample group id
   *
   * @return string
   */
  public function getSampleGroupId() : string {
    return "b6e91a90-c6e9-4612-8ee5-e79f612d6fa6";
  }

  /**
   * Return sample group name
   *
   * @return string
   */
  public function getSampleGroupName() : string {
    return "Lorem Ipsum";
  }

  /**
   * Return sample description
   *
   * @return null|string
   */
  public function getSampleGroupDescription() : ?string {
    return "Lorem ipsum description";
  }
}
