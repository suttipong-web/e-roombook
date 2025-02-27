<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateRoomSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $updateData;
    public function __construct(array $updateData)
    {
        //
        $this->updateData = $updateData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $query = "UPDATE room_schedules SET is_public = CASE id ";
        $ids = [];
        foreach ($this->updateData as $update) {
            $query .= "WHEN {$update['id']} THEN 1 ";
            $ids[] = $update['id'];
        }
        $query .= "END, is_public_date = '" . Carbon::now() . "' WHERE id IN (" . implode(',', $ids) . ")";
        DB::statement($query);
    }
}
