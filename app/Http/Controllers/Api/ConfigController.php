<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Http\Resources\Api\ConfigResource;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        $configs = Config::all();
        return sendResponse(ConfigResource::collection($configs), 'Config success !!!');
    }
}
