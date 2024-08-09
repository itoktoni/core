<?php

namespace App\Jobs;

use App\Facades\Model\CategoryModel;
use App\Facades\Model\UserModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\SimpleExcel\SimpleExcelWriter;

class AppendMoreUsers implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public $chunkIndex,
        public $chunkSize,
        public $folder
    ) {
    }

    public function handle()
    {
        if (!file_exists(storage_path("app/users.csv")))
        {
            SimpleExcelWriter::create(storage_path("app/users.csv"))
                   ->addHeader(['id', 'name', 'email']);
        }
        else
        {
            $users = UserModel::query()
                ->orderBy('id', 'asc')
                ->skip(($this->chunkIndex - 1) * $this->chunkSize)
                ->take($this->chunkSize)
                ->get()
                ->map(function ($user) {
                    return [
                        $user->id,
                        $user->name,
                        $user->email,
                    ];
                });

            $file = storage_path("app/users.csv");
            $open = fopen($file, 'a+');
            foreach ($users as $user) {
                fputcsv($open, $user);
            }
            fclose($open);
        }

    }

    private function usersGenerator($users)
    {
        foreach ($users as $user) {
            yield $user;
        }
    }
}
