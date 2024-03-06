<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class GalleriesFilter extends ApiFilter {
    protected $allowParams = [
        'product_id' => ['eq']
    ];

    protected $columnMap = [];
}