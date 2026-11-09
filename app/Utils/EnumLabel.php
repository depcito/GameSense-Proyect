<?php

namespace App\Utils;

use Illuminate\Support\Facades\Lang;

class EnumLabel
{
    /**
     * Translate a value stored in the database (a status, a payment method, a role...).
     * The translation lives in lang/<locale>/<group>.<value>. If it has no translation, the stored value is returned.
     */
    public static function for(string $group, string $value): string
    {
        $key = $group.'.'.$value;

        return Lang::has($key) ? __($key) : $value;
    }
}
