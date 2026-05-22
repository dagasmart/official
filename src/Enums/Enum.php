<?php

namespace DagaSmart\Official\Enums;

enum Enum
{
    /**
     * 导航类型
     *
     * @return array|array[]
     */
    public static function url_type(): array
    {
        return [
            ['value' => '1', 'label' => '路由', 'color' => 'info'],
            ['value' => '2', 'label' => '外链', 'color' => 'warning'],
            ['value' => '3', 'label' => 'iframe', 'color' => 'success'],
        ];
    }

    /**
     * 是否类型
     *
     * @return array|array[]
     */
    public static function switch(): array
    {
        return [
            ['label' => '是', 'value' => 1],
            ['label' => '否', 'value' => 0],
        ];
    }
}
