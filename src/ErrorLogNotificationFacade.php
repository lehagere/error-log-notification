<?php

namespace Lehagere\ErrorLogNotification;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lehagere\ErrorLogNotification\Skeleton\SkeletonClass
 */
class ErrorLogNotificationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'error-log-notification';
    }
}
