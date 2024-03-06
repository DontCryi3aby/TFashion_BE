<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ReviewsFilter extends ApiFilter {
    protected $allowParams = [
        'product_id' => ['eq'],
        'customer_id' => ['eq'],
        'rate' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $columnMap = [];
}