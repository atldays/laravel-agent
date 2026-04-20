<?php

namespace Atldays\Agent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string userAgent()
 * @method static string hash()
 * @method static ?\Atldays\Agent\Contracts\OsContract os()
 * @method static ?\Atldays\Agent\Contracts\BrowserContract browser()
 * @method static ?\Atldays\Agent\Contracts\BotContract bot()
 * @method static ?\Atldays\Agent\Contracts\DeviceContract device()
 * @method static array toArray()
 *
 * @see \Atldays\Agent\Agent
 */
class Agent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'agent';
    }
}
