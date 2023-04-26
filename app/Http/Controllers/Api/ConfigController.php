<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        $configs = Config::all();
        return response($configs, 200);
    }
}