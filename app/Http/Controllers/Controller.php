<?php

namespace App\Http\Controllers;

use App\Traits\APIResponsesTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use APIResponsesTrait, AuthorizesRequests, ValidatesRequests;
}
