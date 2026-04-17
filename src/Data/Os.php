<?php

namespace Atldays\Agent\Data;

use Atldays\Agent\Contracts\OsContract;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class Os extends Data implements OsContract
{
    use Concerns\NormalizesStrings;

    public function __construct(
        #[Required, StringType]
        public readonly string $name,
        public readonly ?string $shortName = null,
        public readonly ?string $version = null,
        public readonly ?string $family = null,
        public readonly ?string $platform = null
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function shortName(): ?string
    {
        return $this->shortName;
    }

    public function version(): ?string
    {
        return $this->version;
    }

    public function family(): ?string
    {
        return $this->family;
    }

    public function platform(): ?string
    {
        return $this->platform;
    }

    public function isApple(): bool
    {
        return $this->matchesAny($this->name(), ['ios', 'mac', 'macos'])
            || $this->matchesAny($this->family(), ['ios', 'mac', 'macos'])
            || $this->matchesAny($this->shortName(), ['ios', 'mac']);
    }

    public function isAndroid(): bool
    {
        return $this->matchesAny($this->name(), ['android'])
            || $this->matchesAny($this->family(), ['android']);
    }

    public function isIos(): bool
    {
        return $this->matchesAny($this->name(), ['ios'])
            || $this->matchesAny($this->family(), ['ios'])
            || $this->matchesAny($this->shortName(), ['ios']);
    }

    public function isLinux(): bool
    {
        return $this->matchesAny($this->name(), ['linux'])
            || $this->matchesAny($this->family(), ['linux']);
    }

    public function isMacOs(): bool
    {
        return $this->matchesAny($this->name(), ['mac', 'macos'])
            || $this->matchesAny($this->family(), ['mac', 'macos'])
            || $this->matchesAny($this->shortName(), ['mac']);
    }

    public function isWindows(): bool
    {
        return $this->matchesAny($this->name(), ['windows'])
            || $this->matchesAny($this->family(), ['windows'])
            || $this->matchesAny($this->shortName(), ['win']);
    }
}
