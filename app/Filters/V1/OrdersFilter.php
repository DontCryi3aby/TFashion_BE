<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class OrdersFilter extends ApiFilter {
    protected $allowParams = [
        'user_id' => ['eq'],
        'email' => ['eq'],
        'phone_number' => ['eq'],
        'order_date' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
        'total_money' => ['eq', 'lt', 'lte', 'gt', 'gte']
    ];

    protected $columnMap = [];
}