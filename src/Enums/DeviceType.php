<?php

namespace Atldays\Agent\Enums;

enum DeviceType: string
{
    case Desktop = 'desktop';
    case Smartphone = 'smartphone';
    case Tablet = 'tablet';
    case FeaturePhone = 'feature_phone';
    case Console = 'console';
    case TV = 'tv'; // including set-top boxes, blu-ray players,...
    case CarBrowser = 'car_browser';
    case SmartDisplay = 'smart_display';
    case Camera = 'camera';
    case PortableMediaPlayer = 'portable_media_player';
    case Phablet = 'phablet';
    case SmartSpeaker = 'smart_speaker';
    case Wearable = 'wearable'; // including set watches, headsets
    case Peripheral = 'peripheral'; // including portable terminal, portable projector

    public static function hasValue(string $value): bool
    {
        return collect(self::cases())->contains(static fn (self $case): bool => $case->value === $value);
    }

    /**
     * @return array<string>
     */
    public static function toArray(): array
    {
        return array_map(static fn (self $case): string => $case->value, self::cases());
    }
}
