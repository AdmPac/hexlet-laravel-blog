<?php

namespace App\Listeners;

use App\Events\UserVerified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\LogCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendVerificationMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserVerified $event)
    {
        Log::info('SendVerificationMail handler triggered', ['email' => $event->data['email']]);

        try {
            Mail::to($event->data['email'])->send(new LogCode($event->data['code']));
            session($event->data);
        } catch (\Exception $e) {
            Log::error('Error sending mail: ' . $e->getMessage());
            return response()->json(['error' => 'Ошибка при отправке письма: ' . $e->getMessage()], 500);
        }
    }
}
