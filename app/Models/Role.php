<?php

namespace App\Models;

use App\Domain\Model\IF30Model;
use Illuminate\Database\Eloquent\Model;

/**
 * Role model
 *
 * @version 1.0.0
 * @since 0.1.0
 * @author Fathalfath30
 *
 * @property string id
 * @property string name
 * @property ?string short_description
 * @property string created_at
 * @property string updated_at
 * @property ?string deleted_at
 */
class Role extends Model implements IF30Model
{
  protected $table = 'roles';

  protected $primaryKey = 'id';
  public $incrementing = false;
}
