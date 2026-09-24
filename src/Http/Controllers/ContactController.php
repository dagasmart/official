<?php

namespace DagaSmart\Official\Http\Controllers;

use DagaSmart\BizAdmin\Renderers\Page;
use DagaSmart\Official\Services\ContactService;

class ContactController extends AdminController
{
    protected string $serviceName = ContactService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->headerToolbar([
                $this->createButton('dialog', 250),
                ...$this->baseHeaderToolBar(),
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
                    ->set('fixed', 'left'),
                amis()->TableColumn('device_name', '设备名称')->width(200),
                amis()->TableColumn('device_sn', '设备编号')
                    ->searchable([
                        'name' => 'device_sn',
                        'type' => 'input-text',
                        'placeholder' => '请输入设备编号',
                    ])
                    ->copyable()
                    ->width(150),
                amis()->TableColumn('rel.organization.organization_name', '机构单位')
                    ->searchable()
                    ->width(200),
                amis()->TableColumn('rel.facility.level_name', '设施主体')
                    ->width(150),
                amis()->TableColumn('state', '使用状态')
                    ->set('type', 'switch')
                    ->set('onText', '开启')
                    ->set('offText', '禁用'),
                amis()->TableColumn('sort', '排序'),
                amis()->TableColumn('updated_at', '更新时间')
                    ->type('datetime')
                    ->sortable()
                    ->width(150),
                $this->rowActions(),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        return $this->baseForm()->body([]);
    }



}
