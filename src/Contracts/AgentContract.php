<?php

namespace Atldays\Agent\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface AgentContract extends Arrayable
{
    public function userAgent(): string;

    public function hash(): string;

    public function os(): ?OsContract;

    public function browser(): ?BrowserContract;

    public function bot(): ?BotContract;

    public function device(): ?DeviceContract;
}
