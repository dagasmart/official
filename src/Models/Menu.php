<?php

namespace DagaSmart\Official\Models;


use DagaSmart\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;

    protected $table = 'official_menu';

    public function getParentIdAttribute($value): ?int
    {
        if (empty($value)) {
            return null;
        }

        return $value;
    }
}
