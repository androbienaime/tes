<?php

namespace App\Listeners;

use App\Events\RegisteredBranchEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisteredBranchListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RegisteredBranchEvent  $event
     * @return void
     */
    public function handle(RegisteredBranchEvent $event)
    {
        return __("The Surcusal ".$event->branch->name." has been recorded");
    }
}
