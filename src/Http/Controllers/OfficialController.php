<?php

namespace DagaSmart\Official\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class OfficialController extends AdminController
{
    public function index(): JsonResponse|JsonResource
    {
        $page = $this->basePage()->body('Official Extension.');

        return $this->response()->success($page);
    }
}
