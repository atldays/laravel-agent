<?php

namespace Atldays\Agent\Data;

use Atldays\Agent\Contracts\BrowserContract;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class Browser extends Data implements BrowserContract
{
    use Concerns\NormalizesStrings;

    public function __construct(
        #[Required, StringType]
        public readonly string $name,
        public readonly ?string $shortName,
        public readonly ?string $version = null,
        public readonly ?string $family = null,
        public readonly ?string $engine = null,
        public readonly ?string $engineVersion = null,
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

    public function engine(): ?string
    {
        return $this->engine;
    }

    public function engineVersion(): ?string
    {
        return $this->engineVersion;
    }

    public function isChrome(): bool
    {
        return $this->matchesAny($this->name(), ['chrome'])
            || $this->matchesAny($this->family(), ['chrome'])
            || $this->matchesAny($this->shortName(), ['ch']);
    }

    public function isEdge(): bool
    {
        return $this->matchesAny($this->name(), ['edge', 'microsoft edge'])
            || $this->matchesAny($this->family(), ['edge'])
            || $this->matchesAny($this->shortName(), ['ed']);
    }

    public function isFirefox(): bool
    {
        return $this->matchesAny($this->name(), ['firefox'])
            || $this->matchesAny($this->family(), ['firefox'])
            || $this->matchesAny($this->shortName(), ['ff']);
    }

    public function isOpera(): bool
    {
        return $this->matchesAny($this->name(), ['opera'])
            || $this->matchesAny($this->family(), ['opera'])
            || $this->matchesAny($this->shortName(), ['op']);
    }

    public function isSafari(): bool
    {
        return $this->matchesAny($this->name(), ['safari'])
            || $this->matchesAny($this->family(), ['safari'])
            || $this->matchesAny($this->shortName(), ['sf']);
    }
}
