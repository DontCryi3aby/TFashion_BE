<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CategoriesFilter extends ApiFilter {
    protected $allowParams = [
        'name' => ['eq']
    ];

    protected $columnMap = [];
}