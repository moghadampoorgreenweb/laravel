<?php namespace App\Repositores;


use App\Models\Email;
use Illuminate\Http\Request;


class EmailRepositore
{

    protected  $emailModel;

    public function __construct()
    {
        $this->emailModel = new Email();
    }

    public function create($request)
    {
        $request['status'] = Email::STATUS_PENDING;
      return  $this->emailModel->create([
            'email' => $request['email'],
            'title' => $request['title'],
            'body' => $request['body'],
            'status' => $request['status'],
        ]);
    }

    public function sendingEmail($request)
    {
        $model = $this->emailModel;
        $request->each(function ($item) use ($model) {
            echo $item->id . PHP_EOL;
            $model->where('id', '=', $item->id)->update([
                'status' => Email::STATUS_DONE,
                'sent_at' => now(),
            ]);
        });
    }

    public function updateEmailDone($id)
    {
       // echo $id . PHP_EOL;
        $this->emailModel->where('id', '=', $id)->update([
            'status' => Email::STATUS_DONE,
            'sent_at' => now(),
        ]);
    }
    public function updateEmailFaile($id)
    {
       // echo $id . PHP_EOL;
        $this->emailModel->where('id', '=', $id)->update([
            'status' => Email::STATUS_FAIL,
            'sent_at' => now(),
        ]);
    }

    public function get($column, $value)
    {
        return Email::where($column, '=', $value)->limit(Email::LIMIT)->get();
    }
    public function getStatusPendingOrwere($column, $value)
    {
        return Email::where($column, '=', $value)->where('status','=','pending')->limit(Email::LIMIT)->get();
    }


}
