<?php

namespace DagaSmart\Official\Http\Controllers;

use DagaSmart\BizAdmin\Renderers\Form;
use DagaSmart\BizAdmin\Renderers\Page;
use DagaSmart\Official\Services\MenuService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class MenuController extends AdminController
{
    protected string $serviceName = MenuService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->headerToolbar([
                $this->createButton('dialog',250),
                ...$this->baseHeaderToolBar()
            ])
            ->autoGenerateFilter()
            ->affixHeader()
            ->columnsTogglable()
            ->footable(['expand' => 'first'])
            ->autoFillHeight(true)
            ->interval(10000)
            ->silentPolling()
            ->columns([
                amis()->TableColumn('id', 'ID')
                    ->sortable()
                    ->set('fixed','left'),
                amis()->TableColumn('device_name', '设备名称')->width(200),
                amis()->TableColumn('device_sn','设备编号')
                    ->searchable([
                        'name' => 'device_sn',
                        'type' => 'input-text',
                        'placeholder' => '请输入设备编号'
                    ])
                    ->copyable()
                    ->width(150),
                amis()->TableColumn('rel.enterprise.enterprise_name', '机构单位')
                    ->searchable([
                        'name' => 'enterprise_id',
                        'type' => 'select',
                        'multiple' => false,
                        'searchable' => true,
                        'options' => [],
                    ])
                    ->width(200),
                amis()->TableColumn('rel.facility.level_name', '设施主体')
                    ->searchable([
                        'name' => 'facility_id',
                        'type' => 'tree-select',
                        'multiple' => true,
                        'options' => [],
                    ])
                    ->width(200),
                amis()->TableColumn('device_pos','安装位置')
                    ->searchable([
                        'name' => 'device_pos',
                        'type' => 'select',
                        'options' => []
                    ])
                    ->set('type', 'select')
                    ->set('options', [])
                    ->set('static', true),
                amis()->TableColumn('online', '在线状态')
                    ->set('type','mapping')
                    ->set('map', ['*' => [
                        'type' => 'status',
                        'source' => [
                            ['label' => '已离线', 'icon' => 'fail'],
                            ['label' => '运行中', 'icon' => 'success']
                        ]
                    ]]),
                amis()->TableColumn('state', '使用状态')
                    ->set('type','switch')
                    ->set('onText','开启')
                    ->set('offText','禁用'),
                amis()->TableColumn('sort','排序'),
                amis()->TableColumn('updated_at', '更新时间')
                    ->type('datetime')
                    ->sortable()
                    ->width(150),
                $this->rowActions([
                    amis()->Operation()->label(admin_trans('admin.actions'))->buttons([
                        $this->rowShowButton(true,250),
                        $this->rowEditButton(true,250),
                        $this->rowDeleteButton(),
                    ])
                ])
                    ->set('align','center')
                    ->set('fixed','right')
                    ->set('width',180)
            ]);

        return $this->baseList($crud);
    }

    public function form($isEdit = false): Form
    {
        return $this->baseForm()->body([

        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([

        ])->static();
    }


}
