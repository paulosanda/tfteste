<?php

namespace App\Traits;

trait SanitizeTrait
{
    public function sanitizeData($data)
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sanitizedData[$key] = trim(strip_tags($value));
            } else {
                $sanitizedData[$key] = $value;
            }
        }
        return $sanitizedData;
    }
}
