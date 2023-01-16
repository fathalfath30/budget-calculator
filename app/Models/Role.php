<?php

namespace App\Models;

use App\Domain\Model\IF30Model;
use Illuminate\Database\Eloquent\Model;

/**
 * Role model
 *
 * @version 1.0.0
 * @since 0.1.0
 *
 * @property ?string short_description
 * @property string created_at
 * @property string updated_at
 * @property ?string deleted_at
 *
 * @property string id
 * @property string name
 * @author Fathalfath30
 */
class Role extends Model implements IF30Model
{
  protected $table = 'roles';

  protected $primaryKey = 'id';
  public $incrementing = false;
}
