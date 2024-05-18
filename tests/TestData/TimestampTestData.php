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
use Illuminate\Support\Carbon;

/**
 * TimestampTestData
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @author Fathalfath30
 */
trait TimestampTestData {
  const SampleStrDateTime = "2023-01-01 00:00:00";

  /**
   * Return valid sample timestamp entity
   *
   * @param string $value
   *
   * @return \App\Domain\Entity\Timestamp
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function getSampleTimestampEntity(string $value = self::SampleStrDateTime) : Timestamp {
    return Timestamp::create($value, $value, $value);
  }

  /**
   * Return valid timestamp with format Y-m-d H:i:s
   *
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getSampleStrDateTime() : string {
    return self::SampleStrDateTime;
  }

  /**
   * @return \Illuminate\Support\Carbon
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function getSampleDateTimeCarbon() : Carbon {
    return Carbon::parse($this->getSampleStrDateTime());
  }
}
