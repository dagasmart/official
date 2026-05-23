<?php

namespace DagaSmart\Official\Models;


class Menu extends Model
{
    protected $table = 'official_menu';

    public function getParentIdAttribute($value): ?int
    {
        if (empty($value)){
            return null;
        }
        return $value;
    }

}
