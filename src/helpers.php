<?php
use DagaSmart\Official\OfficialServiceProvider;

if (!function_exists('test')) {
    /**
     * 自定义辅助函数
     * @return bool
     */
    function test(): bool
    {
        return true;
    }
}

if (! function_exists('official_trans')) {
    /**
     * 语言包
     */
    function official_trans($key): array|string|null
    {
        return OfficialServiceProvider::trans($key) ?? null;
    }
}
