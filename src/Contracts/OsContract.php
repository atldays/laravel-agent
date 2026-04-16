<?php

namespace Atldays\Agent\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface OsContract extends Arrayable
{
    public function getName(): string;

    public function getShortName(): ?string;

    public function getVersion(): ?string;

    public function getFamily(): ?string;

    public function getPlatform(): ?string;
}
