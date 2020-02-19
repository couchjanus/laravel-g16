<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public $event;

    // public function __construct($event)   {
    //     $this->event = $event;
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');

        // return $this->view('emails.reminder');

        // return $this->from('test@my.cat')
        // ->view('emails.reminder');
        
        // $this->event = 'Hell there';
        
        // return $this->from('test@my.cat')
        // ->view('emails.reminder', ['event'=>$this->event]);
    
        // return $this->from("hello@app.com", "From Cool Comunity")
        //     ->subject("Remember Me Cat!")
        //     ->view("emails.reminder")
        //     ->text('emails.reminder_plain');
    }
}
