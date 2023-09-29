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

use App\Domain\Entity\Auth;
use App\Exceptions\EntityException;
use Exception;
use Tests\TestCase;

/**
 * AuthTest
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class AuthTest extends TestCase {

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
      try {
        new Auth($tc['payload']);
      } catch(Exception $e) {
        /** @var EntityException $e */
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      }
    }
  }
}
