<?php

namespace App\Services;

class DataValidationService
{
    private const CSS_CLASS_PATTERN = '/\.css-[a-z0-9]{7}\{[^}]*\}|\.drom-mobile/';
    private const PERIOD_PATTERN = '/\d{2}\.\d{4} - (\d{2}\.\d{4}|н\.в\.)/';

    /**
     * @param string $data
     * @return string
     */
    public function extractModelName(string $data): string
    {
        $textOnly = strip_tags($data);
        $cleanedText = preg_replace(self::CSS_CLASS_PATTERN, '', $textOnly);

        return trim(preg_replace(self::PERIOD_PATTERN, '', $cleanedText));
    }

    /**
     * @param string $data
     * @return string|null
     */
    public function extractModelPeriod(string $data): ?string
    {
        if (preg_match(self::PERIOD_PATTERN, $data, $matches)) {
            return $matches[0];
        }

        return null;
    }
}
