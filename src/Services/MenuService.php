<?php

namespace DagaSmart\Official\Services;

use DagaSmart\Official\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * 导航菜单-服务类
 *
 * @method Menu getModel()
 * @method Menu|Builder query()
 */
class MenuService  extends AdminService
{
    protected string $modelName = Menu::class;

    public function list(): array
    {
        return ['items' => $this->getTree()];
    }

    public function getTree(): array
    {
        $title = request('title');
        $url = request('url');

        $list = $this->query()
            ->when($title, fn($query) => $query->where('title', 'like', '%' . $title . '%'))
            ->when($url, fn($query) => $query->where('url', 'like', '%' . $url . '%'))
            ->orderBy('custom_order')
            ->orderBy('id')
            ->get()
            ->toArray();

        return array2tree($list);
    }

    public function menuAll($id = null): array
    {
        $rows = $this->query()
            ->select('id', 'title as label', 'id as value', 'parent_id')
            ->when($id, function (Builder $builder) use ($id) {
                $builder->where('id', '!=', $id);
            })
            ->get()
            ->toArray();
        return array2tree($rows);
    }




}
