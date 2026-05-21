<?php

namespace DagaSmart\Official\Http\Controllers;

use DagaSmart\BizAdmin\Renderers\Form;
use DagaSmart\BizAdmin\Renderers\Page;
use DagaSmart\Official\Enums\Enum;
use DagaSmart\Official\Services\MenuService;

class MenuController extends AdminController
{
    protected string $serviceName = MenuService::class;

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
                amis()->TableColumn('title', '菜单名称')->width(200),
                amis()->TableColumn('parent_id', '父级菜单')
                    ->searchable([
                        'name' => 'parent_id',
                        'type' => 'input-text',
                        'placeholder' => '请输入父级菜单',
                    ])
                    ->width(150),
                amis()->TableColumn('url_type', '导航类型')
                    ->searchable([
                        'name' => 'url_type',
                        'type' => 'select',
                        'multiple' => false,
                        'searchable' => false,
                        'options' => Enum::url_type(),
                    ])
                    ->set('type', 'input-tag')
                    ->set('options', Enum::url_type())
                    ->set('static', true)
                    ->width(200),
                amis()->TableColumn('url', '访问url')->width(200)->copyable(),
                amis()->TableColumn('visible', '是否可见')
                    ->searchable([
                        'name' => 'visible',
                        'type' => 'select',
                        'options' => Enum::switch(),
                    ])
                    ->set('type', 'switch')
                    ->set('onText', '是')
                    ->set('offText', '否')
                    ->set('silentPolling', true)
                    ->set('options', Enum::switch()),
                amis()->TableColumn('is_home', '是否首页')
                    ->searchable([
                        'name' => 'is_home',
                        'type' => 'select',
                        'options' => Enum::switch(),
                    ])
                    ->set('type', 'switch')
                    ->set('onText', '是')
                    ->set('offText', '否')
                    ->set('silentPolling', true)
                    ->set('options', Enum::switch()),
                amis()->TableColumn('is_full', '是否页面')
                    ->searchable([
                        'name' => 'is_full',
                        'type' => 'select',
                        'options' => Enum::switch(),
                    ])
                    ->set('type', 'switch')
                    ->set('onText', '是')
                    ->set('offText', '否')
                    ->set('silentPolling', true)
                    ->set('options', Enum::switch()),
                amis()->TableColumn('custom_order', '排序')
                    ->quickEdit([
                        'type' => 'input-number',
                        'size' => 'xs',
                        'silentPolling' => true,
                    ]),
                amis()->TableColumn('updated_at', '更新时间')
                    ->type('datetime')
                    ->sortable()
                    ->width(150),
                $this->rowActions([
                    amis()->Operation()->label(admin_trans('admin.actions'))->buttons([
                        $this->rowShowButton(true, 250),
                        $this->rowEditButton(true, 250),
                        $this->rowDeleteButton(),
                    ]),
                ])
                    ->set('align', 'center')
                    ->set('fixed', 'right')
                    ->set('width', 180),
            ]);

        return $this->baseList($crud);
    }

    public function form($isEdit = false): Form
    {
        return $this->baseForm()->body([
            amis()->SelectControl('parent_id', '父级菜单'),
            amis()->TextControl('title', '菜单标题')->required(),
            amis()->TextControl('icon', '图标')->hidden(),
            amis()->RadiosControl('url_type', '导航类型')->options(Enum::url_type())->value(1),
            amis()->TextControl('url', '${url_type === 1 ? "路由url" : (url_type === 2 ? "跳转url" : "iframe_url")}'),
            amis()->SwitchControl('visible', '是否可见')->option(Enum::switch()),
            amis()->SwitchControl('is_home', '是否首页')->option(Enum::switch()),
            amis()->SwitchControl('is_full', '是否页面')->option(Enum::switch()),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([
            amis()->SelectControl('parent_id', '父级菜单'),
            amis()->TextControl('title', '菜单标题'),
            amis()->TextControl('icon', '图标'),
            amis()->RadiosControl('url_type', '导航类型')->options([
                ['value' => 1, 'label' => '路由'],
                ['value' => 2, 'label' => '外链'],
                ['value' => 3, 'label' => 'iframe'],
            ]),
            amis()->TextControl('url', '访问url'),
            amis()->SwitchControl('visible', '是否可见')->option(Enum::switch()),
            amis()->SwitchControl('is_home', '是否首页')->option(Enum::switch()),
            amis()->SwitchControl('is_full', '是否页面')->option(Enum::switch()),
        ])->static();
    }
}
