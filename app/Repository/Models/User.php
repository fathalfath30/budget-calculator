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

namespace App\Repository\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * This model will handle database operation for user
 *
 * @author Laravel's development team, modified byFathalfath30
 *
 * @version 1.0.0
 * @since 1.0.0
 * @see \Illuminate\Contracts\Auth\Authenticatable
 * @see \Illuminate\Contracts\Auth\Access\Authorizable
 * @see \Illuminate\Contracts\Auth\CanResetPassword
 * @see \Laravel\Sanctum\HasApiTokens
 * @see \Illuminate\Database\Eloquent\Factories\HasFactory
 * @see \Illuminate\Notifications\Notifiable
 * @see \Illuminate\Auth\Authenticatable
 * @see \Illuminate\Foundation\Auth\Access\Authorizable
 * @see \Illuminate\Auth\Passwords\CanResetPassword
 * @see \Illuminate\Auth\MustVerifyEmail
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property ?string $email_verified_at
 * @property string $password
 * @property ?string $remember_token
 * @property ?string $locked_at
 * @property int $login_fail_attempt
 * @property string $created_at
 * @property string $updated_at
 * @property ?string $deleted_at
 *
 * @property \App\Repository\Models\Role[] $roles
 *
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
  use HasApiTokens, HasFactory, Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail,
    SoftDeletes;

  const ID = 'id';
  const FIRST_NAME = 'first_name';
  const LAST_NAME = 'last_name';
  const USERNAME = 'username';
  const EMAIL = 'email';
  const EMAIL_VERIFIED_AT = 'email_verified_at';
  const PASSWORD = 'password';
  const REMEMBER_TOKEN = 'remember_token';
  const LOCKED_AT = 'locked_at';
  const LOGIN_FAIL_ATTEMPT = 'login_fail_attempt';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';


  /** @var string $table set the table name */
  protected $table = 'users';

  /** @var bool $incrementing disabling AUTO_INCREMENT command, we used UUID */
  public $incrementing = false;

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
  protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

  /**
   * @return \Illuminate\Database\Eloquent\Factories\Factory
   */
  protected static function newFactory() : Factory {
    return UserFactory::new();
  }

  public function roles() : BelongsToMany {
    return $this->belongsToMany(Role::class, UserRole::class, UserRole::USER_ID,
      UserRole::ROLE_ID, Role::ID);
  }
}
