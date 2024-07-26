<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ServiceUploadImage implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/cards\.(\d+)\.image/', $attribute, $matches);
        $index = $matches[1] ?? null;

        if ($index !== null) {
            // Check if the image is present in the files section
            $fileImage = request()->file("cards.$index.image");

            if ($fileImage && !$fileImage->isValid()) {
                $fail('The card image must be a valid image file.');
            }
        }
    }
}
