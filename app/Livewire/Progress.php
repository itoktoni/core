<?php

namespace App\Livewire;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\Attributes\Url;

class Progress extends Component
{
    #[Url]
    public $batch = '';
    public $progress = 0;
    public $max = 1;

    public function render()
    {
        $bus = Bus::findBatch($this->batch);

        if($bus)
        {
            $this->max = $bus->totalJobs;
            $this->progress = ($bus->totalJobs - $bus->pendingJobs);
        }

        return view('livewire.progress');
    }
}
