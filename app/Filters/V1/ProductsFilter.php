<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ProductsFilter extends ApiFilter {
    protected $allowParams = [
        'category_id' => ['eq'],
        'title' => ['eq'],
        'description' => ['eq'],
        'quantity' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'price' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'discount' => ['eq', 'gt', 'lt', 'gte', 'lte']
    ];

    protected $columnMap = [];
}