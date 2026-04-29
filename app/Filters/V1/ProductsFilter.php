<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ProductsFilter extends ApiFilter {
    protected $allowParams = [
        'product_type' => ['eq'],
        'title' => ['eq'],
        'handle' => ['eq'],
        'vendor_id' => ['eq'],
        'status' => ['eq'],
    ];

    protected $columnMap = [];
}