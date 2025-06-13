<?php

namespace App\Observers;

use App\Models\RequestForRevision;
use Filament\Notifications\Notification;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(RequestForRevision $task): void
    {
        Notification::make()
         ->title('You have a new task' .$task->status)
         ->sendToDatabase($task->unit_id);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(RequestForRevision $task): void
    {
        //
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(RequestForRevision $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(RequestForRevision $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(RequestForRevision $task): void
    {
        //
    }
}
