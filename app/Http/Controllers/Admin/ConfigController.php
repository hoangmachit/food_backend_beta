<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $configs = Config::all();
        return view('admin.config.index', [
            'configs' => $configs
        ]);
    }
    public function update(Request $request)
    {
        $config = $request->config;
        $config['open_store'] = !empty($config['open_store']) ? "on" : "off";
        foreach ($config as $key => $item) {
            $first_config = Config::whereName($key)->first();
            if ($first_config->value != $item) {
                $first_config->value = $item;
                $first_config->save();
                unset($first_config);
            }
        }
        return redirect()->route('admin.config.index')->with('success', 'Config updated!');
    }
}
