<?php

// 自定义辅助函数

use DagaSmart\Official\Services\SettingService;

if (!function_exists('test')) {
    /**
     * @return bool
     */
    function test(): bool
    {
        return true;
    }

    if (!function_exists('settings')) {
        function settings(): SettingService
        {
            return SettingService::make();
        }
    }


}
