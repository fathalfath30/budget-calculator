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

namespace Domain\Entity;

use App\Domain\Entity\User;
use App\Exceptions\EntityException;
use Exception;
use Tests\TestCase;

/**
 * TimestampTest
 *
 * This class is used to testing some business rules for Timestamp entity, for example
 * testing __constructor and validation and more.
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class UserTest extends TestCase {

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   */
  public function validateInput() {
    $testCase = [
      [
        'name' => 'check id must be filled',
        'expected' => [
          'message' => 'The id field is required.'
        ],
        'payload' => []
      ]
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        new User($tc['payload']);
      } catch(Exception $e) {
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
        $exception = true;
      }

      $this->assertTrue($exception, "validation error");
    }
  }
}
