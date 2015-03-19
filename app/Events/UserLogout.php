<?php namespace Douyasi\Events;

use Douyasi\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserLogout extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }
}
