<?php

namespace Atldays\Agent\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface AgentContract extends Arrayable
{
    public function getUserAgent(): string;

    public function getHash(): string;

    public function getOs(): ?OsContract;

    public function getBrowser(): ?BrowserContract;

    public function getBot(): ?BotContract;

    public function getDevice(): ?DeviceContract;
}
