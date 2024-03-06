<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {
    protected $allowParams = [
        'fullname' => ['eq'],
        'email' => ['eq'],
        'phone_number' => ['eq'],
        'address' => ['eq'],
        'role_id' => ['eq'],
    ];

    protected $columnMap = [];
}