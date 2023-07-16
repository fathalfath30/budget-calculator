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

namespace App\Http\Controllers\API;

use App\Exceptions\NotImplementedException;
use App\Http\Controllers\F30Controller;
use App\Http\Request\Login;
use Exception;

class AuthController extends F30Controller {
  public function login(Login $request) {
    // todo: implement me
    throw new NotImplementedException();
  }

  public function forgotPassword() {
    // todo: implement me
    throw new NotImplementedException();
  }

  public function resetPassword() {
    // todo: implement me
    throw new NotImplementedException();
  }
}
