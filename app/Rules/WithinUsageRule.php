<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WithinUsageRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (($value + auth()->user()->usage()) > auth()->user()->plan->storage) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Usted no tiene suficiente espacio disponible para subir este video, por favor elimine videos o compre un plan con mas capacidad.';
    }
}
