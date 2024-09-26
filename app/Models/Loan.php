<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Loan extends Model
{
    protected $connection = 'mysql';

    protected $table = 'loan_details';

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
       return $date->format('Y-m-d h:i:s');
    }
}