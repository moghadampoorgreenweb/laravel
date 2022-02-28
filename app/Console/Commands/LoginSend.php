<?php

namespace App\Console\Commands;

use App\Mail\InvoiceMail;
use App\Mail\LoginMail;
use App\Repositores\EmailRepositore;
use App\Repositores\FailedRepositore;
use App\Repositories\EmailRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * @property  $email
 */
class LoginSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command For sent Email Login';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $email;
    /**
     * @var FailedRepositore
     */
    protected $fail;

    public function __construct()
    {
        parent::__construct();
        $this->email = new EmailRepositore();
        $this->fail = new FailedRepositore();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->loginMail();
        return 0;
    }

    public function loginMail(): void
    {
        $login = $this->email->getStatusPendingOrwere('type', 'login');
        $i = 0;
        $login->each(function ($item) use (&$i) {

            echo $item->id . ' - ' . $item->email . PHP_EOL;
            try {
                Mail::to($item)->send(new LoginMail($item, $item->id));
                $this->email->updateEmailDone($item->id);
            } catch (\Exception $e) {
                $count = $this->fail->count($item->id);
                $this->fail->ifCount($count, $item, $item->type, $this->email);
                dd($this->fail->count($item->id));
            }

        });
    }

}
