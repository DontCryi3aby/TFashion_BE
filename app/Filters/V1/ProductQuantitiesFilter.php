<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ProductQuantitiesFilter extends ApiFilter {
    protected $allowParams = [
        'product_id' => ['eq'],
        'size_id' => ['eq'],
        'quantity' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $columnMap = [];
}