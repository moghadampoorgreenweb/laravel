<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fail extends Model
{
    use HasFactory;

    protected $table = 'failed_emails';
    const COUNT_FAIL_EMAIL=3;
    protected $guarded = [];


}
