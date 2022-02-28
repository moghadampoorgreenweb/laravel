<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';
    const STATUS_CANCEL = 'cancel';
    const TYPE_WELCOME='welcome';
    const TYPE_INVOICE='invoice';
    const TYPE_LOGIN='login';
    const LIMIT=2;
    protected $table = 'emails';
//    protected $fillable = ['email', 'title', 'body', 'status', 'sent_at'];
    protected $fillable = [
        'email',
        'title',
        'type',
        'status',
        'sent_at',
    ];
//    protected $casts=[
//        'email'=>'json'
//    ];

    public function setEmailAttribute($value)
    {
        is_array($value) ? $this->attributes['email'] =json_encode($value):$this->attributes['email'] =$value;
    }
}
