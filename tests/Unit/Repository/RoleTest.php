<?php

namespace Tests\Unit\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role;
use App\Domain\Repository\IRoleRepository;
use App\Repository\Models\Role as RoleModel;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;

class RoleTest extends TestCase {
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
      $role = RoleModel::create([
        RoleModel::ID => $this->faker->uuid,
        RoleModel::NAME => 'sample roles 1',
        RoleModel::LEVEL => Role::USER_LEVEL_GUEST,
        RoleModel::CREATED_AT => now(),
        RoleModel::UPDATED_AT => now()
      ]);

      $result = $this->repository->get(new DataTables('admin'));
      $this->assertNotNull($result);
      foreach($result as $data) {
        $this->assertInstanceOf(Role::class, $data);
        $this->assertIsString($data->getId());
        $this->assertIsString($data->getName());
        $this->assertIsInt($data->getLevel());
      }

      $role->delete();
    } catch(NotFoundExceptionInterface|ContainerExceptionInterface|Exception $e) {
      $this->assertNull($e);
    }
  }
}
