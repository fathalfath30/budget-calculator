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

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Auth;
use App\Domain\Entity\Password;
use App\Domain\Entity\Pin;
use Tests\TestCase;
use Tests\TestData\PasswordTestData;
use Tests\TestData\PinTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Auth
 * @see \App\Domain\Entity\Password
 * @see \App\Domain\Entity\Pin
 * @see \Tests\TestData\PasswordTestData
 * @see \Tests\TestData\PinTestData
 *
 * @author Fathalfath30
 */
class AuthTest extends TestCase {
  use PasswordTestData, PinTestData;

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox it can rebuild auth entity
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function itCanRebuildAuth() {
    $result = Auth::rebuild($this->getPasswordEntity(), $this->getSamplePinEntity());
    $this->assertNotNull($result);
    $this->assertInstanceOf(Auth::class, $result);

    $this->assertNotNull($result->getPassword());
    $this->assertInstanceOf(Password::class, $result->getPassword());

    $this->assertNotNull($result->getPin());
    $this->assertInstanceOf(Pin::class, $result->getPin());
  }
}
