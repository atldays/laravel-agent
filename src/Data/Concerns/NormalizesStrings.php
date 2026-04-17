<?php

namespace Atldays\Agent\Data\Concerns;

trait NormalizesStrings
{
    protected function matchesAny(?string $value, array $expected): bool
    {
        if ($value === null) {
            return false;
        }

        return in_array(strtolower(trim($value)), $expected, true);
    }

    protected function containsAny(?string $value, array $expected): bool
    {
        if ($value === null) {
            return false;
        }

        $normalized = strtolower(trim($value));

        foreach ($expected as $item) {
            if (str_contains($normalized, strtolower($item))) {
                return true;
            }
        }

        return false;
    }
}
