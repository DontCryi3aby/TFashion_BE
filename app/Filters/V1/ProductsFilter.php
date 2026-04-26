<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ProductsFilter extends ApiFilter {
    protected $allowParams = [
        'product_type' => ['eq'],
        'title' => ['eq'],
        'handle' => ['eq'],
        'vendor' => ['eq'],
        'quantity' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'price' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'discount' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'status' => ['eq'],
    ];

    protected $columnMap = [];
}