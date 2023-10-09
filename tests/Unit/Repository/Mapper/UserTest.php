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

namespace Repository\Mapper;

use App\Domain\Entity\User as UserEntity;
use App\Repository\Mapper\User as UserMapper;
use App\Repository\Models\User as UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestData\UserTestData;

class UserTest extends TestCase {
  use UserTestData, RefreshDatabase;

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   */
  public function itCanMappingFromModelToUserEntity() {
    $userModel = UserModel::factory()->create();
  }
}
