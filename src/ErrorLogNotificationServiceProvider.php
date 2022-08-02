<?php

namespace Lehagere\ErrorLogNotification;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Event;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Config;
use Lehagere\ErrorLogNotification\Models\ErrorLogEntry;

class ErrorLogNotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'error-log-notification');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app->booted(function () {
            $config = Config::get('error-log-notification');
            $schedule = $this->app->make(Schedule::class);
            $schedule->command(Commands\ErrorLogNotificationCommand::class)->dailyAt($config['delivery_time']);
        });

        Event::listen(MessageLogged::class, function (MessageLogged $e) {
            $config = Config::get('error-log-notification');
            $exception = $e->context['exception'];
            if (in_array($e->level, ['error'])) {
                $input = [
                    'context' => $config['context'] ?? 'None',
                    'level' => $e->level,
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine()
                ];
                ErrorLogEntry::create($input);
            }
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('error-log-notification.php'),
            ], 'config');

            $this->commands([
                Commands\ErrorLogNotificationCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'error-log-notification');
    }
}
