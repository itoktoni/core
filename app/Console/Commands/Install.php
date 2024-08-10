<?php

namespace App\Console\Commands;

use App\Dao\Enums\Core\NotificationStatus;
use App\Dao\Models\Core\User;
use App\Dao\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Plugins\WhatsApp;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:whatsapp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'untuk mengirimkan whatsapp otomatis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(range(1, 100) as $item){
            User::factory(100)->create();
        }
    }
}
