<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class OrderDetailsFilter extends ApiFilter {
    protected $allowParams = [
        'product_id' => ['eq'],
        'order_id' => ['eq'],
    ];

    protected $columnMap = [];
}