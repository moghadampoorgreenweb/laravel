<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositores\EmailRepositore;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $emailRepositore;

    public function __construct()
    {
        $this->emailRepositore = new EmailRepositore();
    }

    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        return response()->json($this->emailRepositore->create($request->only('email', 'title', 'body')));
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'email' => 'required|array',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        return response()->json($this->emailRepositore->create($request->only('email', 'title', 'body')));
    }

    public function show()
    {
        return $this->emailRepositore->get('status', 'pending').PHP_EOL;
        // $this->emailRepositore->sendingEmail($call);
    }
}
