<?php

namespace Atldays\Agent\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface BrowserContract extends Arrayable
{
    public function name(): string;

    public function shortName(): ?string;

    public function version(): ?string;

    public function family(): ?string;

    public function engine(): ?string;

    public function engineVersion(): ?string;
}
