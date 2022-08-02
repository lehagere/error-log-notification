<?php

namespace Lehagere\ErrorLogNotification\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Lehagere\ErrorLogNotification\Models\ErrorLogEntry;

class ErrorLogNotificationCommand extends Command
{
    protected $signature = 'notify:log';
    protected $description = 'Notify the administrator on the list of error logs';

    public function handle()
    {
        $config = Config::get('error-log-notification');
        $emails = $config['email']['to'];
        $title = $config['email']['title'];
        $errors = ErrorLogEntry::where('created_at', '<', date('Y-m-d', strtotime("{$config['duration']} days ago")))->get();
        Mail::send('notification', [
            'errors' => $errors
        ], function ($message) use ($emails, $title) {
            $message->to($emails)->subject($title);
        });
        return 0;
    }
}
