<?php

namespace Atldays\Agent\Contracts;

use Atldays\Agent\Enums\DeviceType;
use Illuminate\Contracts\Support\Arrayable;

interface DeviceContract extends Arrayable
{
    public function type(): DeviceType;

    public function device(): string;

    public function brand(): ?string;

    public function model(): ?string;
}
