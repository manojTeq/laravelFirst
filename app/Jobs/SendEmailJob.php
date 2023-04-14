<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailTest;
use Illuminate\Support\Facades\Mail;



class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        // dd($user);
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $users = $this->user;
        // dd($users);        
        // $email = new SendEmailTest();
        // dd($email);
        // Mail::to($this->data)->send($email);
        Mail::to($users->email)->send(new SendEmailTest($users));
        // Mail::to($this->data['email'])->send($email);
        //
    }
}
