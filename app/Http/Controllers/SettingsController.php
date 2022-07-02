<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $data['setting'] = Settings::latest()->first();
        return view('settings.index', $data);
    }

    public function update($id){
        $setting = Settings::find($id);
        $setting->update(request()->all());
        $notification = array(
            'message' => 'Settings updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
