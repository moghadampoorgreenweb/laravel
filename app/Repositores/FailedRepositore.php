<?php

namespace App\Repositores;

use App\Models\Fail;

class FailedRepositore
{

    /**
     * @var Fail
     */
    protected $fail;


    public function __construct()
    {
        $this->fail = new Fail();
    }

    public function create($id, $type)
    {
        $this->fail->insert([
            'email_id' => $id,
            'Message_type' => $type,
            'failed_at' => now(),
        ]);
    }

    public function count($id)
    {
        return Fail::where('email_id', '=', $id)->count();
    }

    public function ifCount($count, $item, $type, EmailRepositore $emailRepositore): void
    {
        if ($count < Fail::COUNT_FAIL_EMAIL) {
            $this->create($item->id, $type);
        }
        if ($count == Fail::COUNT_FAIL_EMAIL) {
            $emailRepositore->updateEmailFaile($item->id);
        }
    }
}
