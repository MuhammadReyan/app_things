<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_data)
    {
        $this->file_data = $file_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = $this->file_data['disk'];
        $filename = $this->file_data['filename'];

        Storage::disk($disk)->delete(
            [
                $filename
            ]
        );
    }
}
