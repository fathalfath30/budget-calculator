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

use App\Domain\Entity\Pin;
use Illuminate\Support\Carbon;

/**
 * PinTestData
 * This trait will have valid pin and valid pin_last_updated
 *
 * @see \App\Domain\Entity\Pin
 * @see \Illuminate\Support\Carbon
 */
trait PinTestData {

  /**
   * @return string
   */
  public function getSamplePin() : string {
    return "503829";
  }

  /**
   * @return string
   */
  public function getSampleStrLastUpdated() : string {
    return "2023-01-01 00:00:00";
  }

  /**
   * @return \Illuminate\Support\Carbon
   */
  public function getSampleLastUpdated() : Carbon {
    return Carbon::parse($this->getSampleStrLastUpdated());
  }

  /**
   * @return \App\Domain\Entity\Pin
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function getSamplePinEntity() : Pin {
    return Pin::create($this->getSamplePin(), $this->getSampleLastUpdated());
  }
}
