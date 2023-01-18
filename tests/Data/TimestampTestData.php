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

namespace Tests\Data;

use App\Domain\Entity\Timestamp;

/**
 * @version 1.0.0
 * @since 0.1.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @author Fathalfath30
 *
 * @codeCoverageIgnore
 */
class TimestampTestData {
  /**
   * This method will provide static timestamp, and it will set on the
   * date when I was born, but not with hours haha
   *
   * @return string
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function validStrTimestamp() : string {
    return "2023-09-23 00:00:00";
  }

  /**
   * It will return timestamp object, and it will use my birthday date hahaha
   *
   * @param bool $useDeletedAt
   *
   * @return \App\Domain\Entity\Timestamp
   * @throws \App\Exceptions\EntityException
   */
  public static function validTimestampEntity(bool $useDeletedAt = false) : Timestamp {
    return Timestamp::create(self::validStrTimestamp(), self::validStrTimestamp(),
      ($useDeletedAt) ? self::validStrTimestamp() : null);
  }
}
