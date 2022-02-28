<?php

namespace App\Console\Commands;

use App\Mail\InvoiceMail;
use App\Mail\WelocmeMail;
use App\Repositores\EmailRepositore;
use App\Repositores\FailedRepositore;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WelcomeSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command For sent Email Welcome';
    private $email;
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
     * @return int
     */
    public function handle()
    {
        $this->welcomeMail();
        return 0;
    }

    public function welcomeMail(): void
    {
        $login = $this->email->getStatusPendingOrwere('type', 'welcome');
        $login->each(function ($item) {
            echo $item->id . ' - ' . $item->email . PHP_EOL;
            try {
                Mail::to($item)->send(new WelocmeMail($item, $item->id));
                $this->email->updateEmailDone($item->id);
            } catch (\Exception $e) {
                $count = $this->fail->count($item->id);
                $this->fail->ifCount($count, $item, $item->type, $this->email);
                d($this->fail->count($item->id));
            }
        });
    }


}
