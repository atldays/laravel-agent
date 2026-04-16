<?php

namespace Atldays\Agent\Data;

use Atldays\Agent\Contracts\DeviceContract;
use Atldays\Agent\Enums\DeviceType;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class Device extends Data implements DeviceContract
{
    public function __construct(
        #[Required, StringType]
        public readonly string $device,
        public readonly ?string $brand = null,
        public readonly ?string $model = null
    ) {}

    public function getType(): DeviceType
    {
        $type = Str::snake($this->device);

        return DeviceType::hasValue($type) ? DeviceType::from($type) : DeviceType::Desktop;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }
}
