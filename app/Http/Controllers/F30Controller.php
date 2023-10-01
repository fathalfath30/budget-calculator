<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * F30Controller
 * This is class is modified from Laravel existing Controller
 *
 * @version 1.0.0
 *
 * @since 1.0.0
 * @see BaseController
 */
class F30Controller extends BaseController {
  use AuthorizesRequests, ValidatesRequests;
}
