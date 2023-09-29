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

trait TimestampTestData {
  const SAMPLE_DATE_TIME = "2023-01-01 00:00:00";

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function ValidTimestampEntity() : Timestamp {
    return new Timestamp([
      Timestamp::CREATED_AT => self::SAMPLE_DATE_TIME,
      Timestamp::UPDATED_AT => self::SAMPLE_DATE_TIME,
      Timestamp::DELETED_AT => self::SAMPLE_DATE_TIME
    ], false);
  }
}
