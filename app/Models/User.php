<?php

namespace App\Models;

use App\Domain\Model\IF30Model;
use App\Traits\F30Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User Model
 *
 * @version 1.0.0
 * @since 0.1.0
 * @author Fathalfath30, Laravel Developer Team
 *
 * @property string id
 * @property string name
 * @property string email
 * @property string email_verified_at
 * @property string password
 * @property string password_updated_at
 * @property string role_id
 * @property string created_at
 * @property string updated_at
 */
class User extends Authenticatable implements IF30Model
{
  use HasApiTokens, HasFactory, Notifiable, F30Model;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['name', 'email', 'password'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = ['email_verified_at' => 'datetime'];
}
