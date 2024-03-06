<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class FeedbacksFilter extends ApiFilter {
    protected $allowParams = [
        'email' => ['eq'],
        'subject' => ['eq'],
        'phone_number' => ['eq']
    ];

    protected $columnMap = [];
}