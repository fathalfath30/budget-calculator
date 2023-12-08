<?php

namespace App\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role;
use App\Domain\Repository\IRoleRepository;
use App\Exceptions\NotImplementedException;
use App\Repository\Mapper\Role as RoleMapper;

class RoleRepository implements IRoleRepository {

  /**
   * @param null|\App\Domain\Entity\DataTables $dataTables
   *
   * @return null|array|\App\Domain\Entity\Role[]
   * @throws \App\Exceptions\EntityValidationException
   */
  public function get(?DataTables $dataTables) : ?array {
    $result = [];

    // initiate model
    $model = Models\Role::select();

    if(!is_null($dataTables)) {
      // assign datatables filter
      if(!empty($dataTables->getKeyword())) {
        if(!empty($dataTables->getSearchBy())) {

          $model->where($dataTables->getSearchBy(), 'like', '%' . $dataTables->getKeyword() . '%');
        } else {
          $model->where(function($q) use ($dataTables) {
            $q->orWhere('id', 'like', '%' . $dataTables->getKeyword() . '%');
            $q->orWhere('name', 'like', '%' . $dataTables->getKeyword() . '%');
            $q->orWhere('level', 'like', '%' . $dataTables->getKeyword() . '%');
          });
        }
      }
    }

    foreach($model->get() as $data) {
      $result[] = RoleMapper::fromModelToEntity($data);
    }

    return $result;
  }

  public function insert(Role $payload) : Role {
    // TODO: Implement insert() method.
    throw new NotImplementedException;
  }
}
