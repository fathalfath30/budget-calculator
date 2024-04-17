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

namespace App\Domain\Repository;

use App\Domain\Entity\DataTables;
use App\Domain\Entity\Role;

interface IRoleRepository {
  /**
   * Get all available role on database base on $dataTables
   * parameter
   *
   * @param null|\App\Domain\Entity\DataTables $dataTables
   *
   * @return null|array|\App\Domain\Entity\Role[]
   * @throws \App\Exceptions\EntityValidationException
   *
   * @author fathalfath30
   * @version 1.0.0
   */
  public function get(DataTables $dataTables) : ?array;

  /**
   * Insert new data to role table
   *
   * @param \App\Domain\Entity\Role $payload
   *
   * @return \App\Domain\Entity\Role
   * @throws \App\Exceptions\RepositoryException
   *
   * @author fathalfath30
   * @version 1.0.0
   */
  public function insert(Role $payload) : Role;
}
