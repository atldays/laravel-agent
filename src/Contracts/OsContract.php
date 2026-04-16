<?php

namespace Atldays\Agent\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface OsContract extends Arrayable
{
    public function name(): string;

    public function shortName(): ?string;

    public function version(): ?string;

    public function family(): ?string;

    public function platform(): ?string;
}
