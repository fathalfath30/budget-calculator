<?php

namespace App\Models;

use App\Domain\Model\IF30Model;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements IF30Model
{
  protected $table = 'roles';

  protected $primaryKey = 'id';
  public $incrementing = false;
}
