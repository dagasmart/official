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
class MenuService extends AdminService
{
    protected string $modelName = Menu::class;

    public function list(): array
    {
        return ['items' => $this->getTree()];
    }

    public function getTree(): array
    {
        $title = request('title');
        $url_type = request('url_type');
        $visible = request('visible');
        $is_home = request('is_home');
        $is_full = request('is_full');

        $parent_id = request('parent_id');
        $ids = $this->query()->find($parent_id, ['id'])?->descendantsAndSelf->pluck('id');

        $list = $this->query()
            ->tree()
            ->when($title, fn ($query) => $query->where('title', 'like', '%'.$title.'%'))
            ->when($url_type, fn ($query) => $query->whereIn('url_type', explode(',', $url_type)))
            ->when(! is_null($visible), fn ($query) => $query->whereIn('visible', explode(',', $visible)))
            ->when(! is_null($is_home), fn ($query) => $query->whereIn('is_home', explode(',', $is_home)))
            ->when(! is_null($is_full), fn ($query) => $query->whereIn('is_full', explode(',', $is_full)))
            ->when($parent_id, function (Builder $query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->orderBy('custom_order')
            ->orderBy('id')
            ->get()
            ->toTree();

        return $list->loadTreeRelationships()->toArray();
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
