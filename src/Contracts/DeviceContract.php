<?php

namespace Atldays\Agent\Contracts;

use Atldays\Agent\Enums\DeviceType;
use Illuminate\Contracts\Support\Arrayable;

interface DeviceContract extends Arrayable
{
    public function getType(): DeviceType;

    public function getDevice(): string;

    public function getBrand(): ?string;

    public function getModel(): ?string;
}
