<?php

namespace App\Console\Commands;

use App\Mail\InvoiceMail;
use App\Mail\LoginMail;
use App\Mail\WelocmeMail;
use App\Models\Email;
use App\Models\Fail;
use App\Repositores\EmailRepositore;


use App\Repositores\FailedRepositore;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'This Command For Send Pending Emails';

    protected $emailSend;
    protected $email;
    /**
     * @var FailedRepositore
     */
    protected $fail;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->email = new EmailRepositore();
        $this->fail = new FailedRepositore();
    }

    /**
     * Execute the console command.
     *

     */
    public function handle()
    {


        $this->invoiceMail();

//        $emails = $result->map(function ($item) {
//            if (is_array(json_decode($item->email))) {
//                return json_decode($item);
//            } else {
//                $bool = $this->emailSend->SendingEmail($item);
//                if ($bool) {
//                    $this->email->updateEmail($item->id);
//                }
//            }
//        });
    }


    /**
     * @return void
     */


    public function invoiceMail(): void
    {
        $login = $this->email->getStatusPendingOrwere('type', 'invoice');

        $login->each(function ($item) {
            echo $item->id . ' - ' . $item->email . PHP_EOL;
            try {
                Mail::to($item)->send(new InvoiceMail($item, $item->id));
                $this->email->updateEmailDone($item->id);
            } catch (\Exception $e) {
                $count = $this->fail->count($item->id);
                $this->fail->ifCount($count, $item, $item->type, $this->email);
                d($this->fail->count($item->id));
            }

        });
    }


}

