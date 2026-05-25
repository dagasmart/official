<?php

namespace DagaSmart\Official\Models;

use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Menu extends Model
{
    use HasRecursiveRelationships;

    protected $table = 'official_menu';

    public function getParentIdAttribute($value): ?int
    {
        if (empty($value)) {
            return null;
        }

        return $value;
    }
}
