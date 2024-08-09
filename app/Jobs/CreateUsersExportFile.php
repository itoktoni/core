<?php

namespace App\Jobs;

use App\Facades\Model\CategoryModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;

class CreateUsersExportFile implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public $chunkSize,
        public $folder
    ) {
    }

    public function handle()
    {
        $users = CategoryModel::query()
            // ->take($this->chunkSize)
            ->get();

        Storage::disk('local')->makeDirectory($this->folder);

        (new \Rap2hpoutre\FastExcel\FastExcel($this->usersGenerator($users)))
        ->export(storage_path("app/{$this->folder}/users.csv"), function ($user) {
            return [
                'id' => $user->history_id,
                'name' => $user->history_rfid,
                'email' => $user->history_waktu,
                // ....
            ];
        });
    }

    private function usersGenerator($users)
    {
        foreach ($users as $user) {
            yield $user;
        }
    }
}
