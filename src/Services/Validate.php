<?php

namespace TheBugSoftware\StareTva\Services;

use TheBugSoftware\StareTva\Exceptions\ValidateException;

/**
 * Validate class.
 *
 * Adapted after https://github.com/alceanicu/cif
 */
class Validate
{
    private $controlKey = [7, 5, 3, 2, 1, 7, 5, 3, 2];

    /**
     * Validate CUI.
     *
     * @param $cui
     *
     * @return bool
     * @throws \TheBugSoftware\StareTva\Exceptions\ValidateException
     */
    public function cui($cui): bool
    {
        if (empty($cui)) {
            throw new ValidateException('The CUI number is required.');
        }

        return $this->validate($cui);
    }

    /**
     * Validate CUI.
     *
     * @param $cui
     *
     * @return bool
     */
    private function validate($cui): bool
    {
        $cui = trim(preg_replace('/[^0-9]/', '', $cui));

        $length = strlen($cui);

        if ($length > 10 || $length < 2) {
            return false;
        }

        $controlKey = (int) substr($cui, -1);
        $cui = substr($cui, 0, -1);
        $cui = str_pad($cui, 9, '0', STR_PAD_LEFT);
        $sum = 0;

        foreach ($this->controlKey as $i => $key) {
            $sum += $cui[$i] * $key;
        }

        $sum = $sum * 10;
        $rest = (int) ($sum % 11);
        $rest = ($rest == 10) ? 0 : $rest;

        if ($rest === $controlKey) {
            return true;
        }

        return false;
    }
}
