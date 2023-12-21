<?php

namespace Tests\Unit\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role as RoleEntity;
use App\Domain\Repository\IRoleRepository;
use App\Exceptions\RepositoryException;
use App\Repository\Models\Role as RoleModel;
use Database\Seeders\RoleSeeder;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Cache\Repository;
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
    // seed database with default roles data
    $this->seed([RoleSeeder::class]);
    try {
      $result = $this->repository->get(new DataTables('admin', null, 1, 1));
      $this->assertNotNull($result);
      $this->assertEquals(1, sizeof($result));

      foreach($result as $data) {
        $this->assertInstanceOf(RoleEntity::class, $data);
        $this->assertIsString($data->getId());
        $this->assertIsString($data->getName());
        $this->assertIsInt($data->getLevel());
      }
    } catch(NotFoundExceptionInterface|ContainerExceptionInterface|Exception $e) {
      $this->assertNull($e);
    }

    try {
      $result = $this->repository->get(new DataTables('admin', 'name', 1, 1));
      $this->assertNotNull($result);
      $this->assertEquals(1, sizeof($result));

      foreach($result as $data) {
        $this->assertInstanceOf(RoleEntity::class, $data);
        $this->assertIsString($data->getId());
        $this->assertIsString($data->getName());
        $this->assertIsInt($data->getLevel());
      }
    } catch(NotFoundExceptionInterface|ContainerExceptionInterface|Exception $e) {
      $this->assertNull($e);
    }
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox it can insert new role into database
   */
  public function itCanInsertNewRole() {
    $data = ['id' => $this->faker->uuid(), 'name' => 'New Role', 'level' => 1];
    $result = $this->repository->insert(new RoleEntity($data['id'], $data['name'], $data['level'], null));
    $this->assertInstanceOf(RoleEntity::class, $result);
    $this->assertDatabaseHas((new RoleModel)->getTable(), $data);
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox it should return repository exception if id has duplicate entry
   */
  public function itShouldReturnRepositoryExceptionIfIdHasDuplicateEntry() : void {
    $this->expectException(RepositoryException::class);

    $data = ['id' => $this->faker->uuid(), 'name' => 'New Role', 'level' => 1];
    $this->repository->insert(new RoleEntity($data['id'], $data['name'], $data['level'], null));
    $this->repository->insert(new RoleEntity($data['id'], $data['name'], $data['level'], null));
  }
}
