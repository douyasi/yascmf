<?php namespace Douyasi\Events;

use Douyasi\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserUpload extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $file)
    {
        //
        $this->user = $user;  //用户信息 object
        $this->file = $file;  //文件信息 array
    }
}
