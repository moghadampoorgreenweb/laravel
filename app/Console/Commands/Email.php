<?php

namespace App\Console\Commands;

use App\Repositores\EmailRepositore;
use App\Services\EmailServiec;
use Illuminate\Console\Command;

class Email extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:sent';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'email sending.';
    protected $emailRepositore;
    protected $emailServiec;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->emailRepositore = new EmailRepositore();
        $this->emailServiec = new EmailServiec();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->emailRepositore->get('status', 'pending');

        $data->each(function ($item) {
            echo $item->id . ' - ' . $item->email . PHP_EOL;
           // dd($item);
           $bool= $this->emailServiec->sendEmail($item->email, $item->subject, $item->body);
            if ($bool){
                $this->emailRepositore->updateEmailDone($item->id);
            }
           // $this->emailRepositore->updateEmailDone($item->id);
        });
        return 0;


        // $this->emailRepositore->sendingEmail($data);


        // echo $data.PHP_EOL;
    }
}
