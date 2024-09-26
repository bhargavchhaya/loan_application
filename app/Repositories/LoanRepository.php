<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Loan;

class LoanRepository extends BaseRepository{

    protected $model;

    public function __construct(Loan $model)
    {
        $this->model = $model;
    }
}