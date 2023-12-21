<?php

namespace Tests\Unit\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role;
use App\Domain\Repository\IRoleRepository;
use Database\Seeders\RoleSeeder;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;

class RoleTest extends TestCase {
  use RefreshDatabase;

  /** @var \App\Domain\Repository\IRoleRepository $repository */
  private IRoleRepository $repository;
  private Generator $faker;

  protected function setUp() : void {
    parent::setUp();

    $this->repository = app(IRoleRepository::class);
    $this->faker = Factory::create(app()->getLocale());
  }

  /**
   * @return void
   * @test
   * @testdox it can display available roles for DataTables
   */
  public function itCanDisplayAvailableRolesForDataTables() {
    try {
      // seed database with default roles data
      $this->seed([RoleSeeder::class]);

      $result = $this->repository->get(new DataTables(null, null, 1, 1));
      $this->assertNotNull($result);
      $this->assertEquals(1, sizeof($result));

      foreach($result as $data) {
        $this->assertInstanceOf(Role::class, $data);
        $this->assertIsString($data->getId());
        $this->assertIsString($data->getName());
        $this->assertIsInt($data->getLevel());
      }
    } catch(NotFoundExceptionInterface|ContainerExceptionInterface|Exception $e) {
      $this->assertNull($e);
    }
  }
}
