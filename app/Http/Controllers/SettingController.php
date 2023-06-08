<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Settings\GeneralSettings
     * @return \Illuminate\Http\Response
     */
    public function index(GeneralSettings $settings)
    {
        return $settings->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Settings\GeneralSettings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralSettings $generalSettings, SettingRequest $request)
    {
        $settings = $request->settings;

        foreach($settings as $setting) {
            $currentSetting = $generalSettings->__get($setting['name']);
            $currentSetting->value = $setting['value'];
            $generalSettings->save();
        }

        return $generalSettings->toArray();
    }
}
