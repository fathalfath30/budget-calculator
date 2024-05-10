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

use Illuminate\Support\Carbon;

/**
 * @see \Tests\TestData\TimestampTestData
 *
 * @version 1.0.0
 * @since 1.0.0
 */
trait EmailTestData {
  use TimestampTestData;

  /**
   * @return string
   */
  private function getSampleEmail() : string {
    return "fathalfath30@gmail.com";
  }

  /**
   * @return \Illuminate\Support\Carbon
   */
  private function getSampleEmailVerifiedAt() : Carbon {
    return Carbon::parse(self::SAMPLE_DATE_TIME);
  }
}
