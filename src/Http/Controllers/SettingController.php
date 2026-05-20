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
            'site_name' => settings()->get('site_name', '网站名称'),
            'logo' => $logo,
            'addition_config' => settings()->get('addition_config'),

        ]);
    }

}
