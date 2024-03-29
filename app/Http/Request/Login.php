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

namespace App\Http\Request;
/**
 * Login
 *
 * This class will handle login request, it should be used by AuthController.
 *
 * @author fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Http\Controllers\API\AuthController
 */
class Login extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize() : bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules() : array {
    return [
      'username' => ['required', 'min:6'],
      'password' => ['required']
    ];
  }
}
