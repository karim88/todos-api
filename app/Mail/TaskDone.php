<?php

namespace App\Mail;

use App\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskDone extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Task $task)
    {
        $this->user = $user->name;
        $this->task = $task->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@karimoc.me')->view('mails.notification');
    }
}
