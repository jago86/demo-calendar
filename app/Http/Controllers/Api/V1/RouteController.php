<?php

namespace App\Http\Controllers\Api\V1;

use App\Route;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function index()
    {
        return Route::select('id', 'title')->get();
    }
}
