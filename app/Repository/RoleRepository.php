<?php

namespace App\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role;
use App\Domain\Repository\IRoleRepository;
use App\Exceptions\RepositoryException;
use App\Repository\Mapper\Role as RoleMapper;
use App\Repository\Models\Role as RoleModel;
use Exception;

/**
 * RoleRepository
 *
 * This class should handle and manipulate role data
 * in database
 *
 * @author fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Repository\IRoleRepository
 * @see \App\Repository\Models\Role
 * @see \App\Domain\Entity\Role
 */
class RoleRepository implements IRoleRepository {

  /** @inheritDoc */
  public function get(?DataTables $dataTables) : ?array {
    $result = [];

    // initiate model
    $model = RoleModel::select();

    // assign datatables filter if databases is not empty
    if(!is_null($dataTables)) {
      // insert keyword to search using specific data
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

      // add pagination filter
      $model->take($dataTables->getLimit())->skip($dataTables->getOffset());
    }

    foreach($model->get() as $data) {
      $result[] = RoleMapper::fromModelToEntity($data);
    }

    return $result;
  }

  /** @inheritDoc */
  public function insert(Role $payload) : Role {
    try {
      $role = new RoleModel;
      $role->id = $payload->getId();
      $role->name = $payload->getName();
      $role->level = $payload->getLevel();
      $role->icon = $payload->getIcon();
      $role->save();
    } catch(Exception $exception) {
      // convert to repository exception
      throw new RepositoryException($exception->getMessage(), 500);
    }

    return $payload;
  }
}
