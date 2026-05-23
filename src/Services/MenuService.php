<?php

namespace DagaSmart\Official\Services;

use DagaSmart\Official\Models\Menu;
use Illuminate\Database\Eloquent\Builder;

/**
 * 导航菜单-服务类
 *
 * @method Menu getModel()
 * @method Menu|Builder query()
 */
class MenuService  extends AdminService
{
    protected string $modelName = Menu::class;

    public function menus(): array
    {
        $rows = $this->query()
            ->select('id', 'title as label', 'id as value', 'parent_id')
            ->get()
            ->toArray();
        return array2tree($rows);
    }




}
