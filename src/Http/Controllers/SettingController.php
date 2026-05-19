<?php

namespace DagaSmart\Official\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class SettingController extends AdminController
{
    public function index()
    {
        return $this->settings();
    }
    public function settings(): JsonResponse|JsonResource
    {
        $logo = admin_image_url(settings()->get('site_logo', url(admin_config('admin.logo'))));

        return $this->response()->success([
            'app_name' => site_settings()->get('site_name', admin_config('admin.name')),
            'logo'     => $logo,
            'addition_config'        => settings()->get('addition_config'),

        ]);
    }

}
