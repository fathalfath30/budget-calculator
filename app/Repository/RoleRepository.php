<?php

namespace App\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role;
use App\Domain\Repository\IRoleRepository;
use App\Exceptions\NotImplementedException;

class RoleRepository implements IRoleRepository {
  public function get(DataTables $dataTables) : ?array {
    // TODO: Implement get() method.
    throw new NotImplementedException;
  }

  public function insert(Role $payload) : Role {
    // TODO: Implement insert() method.
    throw new NotImplementedException;
  }
}
