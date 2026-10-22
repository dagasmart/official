<?php

return [
    /* 默认监控股票池*/
    'symbols' => [
        // '600000', '000001'
    ],

    /* 涨跌幅告警阈值*/
    'alert_percent' => 5,

    /* 行情字段映射（腾讯）*/
    'field_map' => [
        'stock_name'      => 1,
        'symbol'          => 2,
        'price'           => 3,
        'prev_close'      => 4,
        'open'            => 5,
        'volume'          => 6,
        'change'          => 31,
        'change_percent'  => 32,
        'high'            => 33,
        'low'             => 34,
        'amount'          => 37,
        'turnover_rate'   => 38,
        'amplitude'       => 39,
        'main_net_inflow' => 44,
    ],

    /* 接口配置 */
    'api' => [
        'tencent' => 'https://qt.gtimg.cn/q=',
        'timeout' => 8,
    ],
];
