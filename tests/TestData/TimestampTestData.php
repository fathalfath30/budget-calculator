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

use App\Domain\Entity\Timestamp;

/**
 * TimestampTestData
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
trait TimestampTestData {
  const SAMPLE_DATE_TIME = "2023-01-01 00:00:00";

  /**
   * Return valid sample timestamp entity
   *
   * @param string $value
   *
   * @return \App\Domain\Entity\Timestamp
   * @throws \App\Exceptions\EntityValidationException
   */
  public function getValidTimestampEntity(string $value = self::SAMPLE_DATE_TIME) : Timestamp {
    return new Timestamp($value, $value, $value);
  }

  /**
   * Return valid timestamp with format Y-m-d H:i:s
   *
   * @return string
   */
  public function getValidSampleTimestamp() : string {
    return "2023-01-01 00:00:00";
  }
}
