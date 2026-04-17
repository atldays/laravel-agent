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
    use Concerns\NormalizesStrings;

    public function __construct(
        #[Required, StringType]
        public readonly string $device,
        public readonly ?string $brand = null,
        public readonly ?string $model = null
    ) {}

    public function type(): DeviceType
    {
        $type = Str::snake($this->device);

        return DeviceType::hasValue($type) ? DeviceType::from($type) : DeviceType::Desktop;
    }

    public function device(): string
    {
        return $this->device;
    }

    public function brand(): ?string
    {
        return $this->brand;
    }

    public function model(): ?string
    {
        return $this->model;
    }

    public function isDesktop(): bool
    {
        return $this->type() === DeviceType::Desktop;
    }

    public function isMobile(): bool
    {
        return in_array($this->type(), [
            DeviceType::Smartphone,
            DeviceType::FeaturePhone,
            DeviceType::Phablet,
            DeviceType::Tablet,
        ], true);
    }

    public function isTablet(): bool
    {
        return $this->type() === DeviceType::Tablet;
    }

    public function isPhone(): bool
    {
        return in_array($this->type(), [
            DeviceType::Smartphone,
            DeviceType::FeaturePhone,
            DeviceType::Phablet,
        ], true);
    }

    public function isApple(): bool
    {
        return $this->matchesAny($this->brand(), ['apple']);
    }

    public function isIphone(): bool
    {
        return $this->containsAny($this->model(), ['iphone']);
    }
}
