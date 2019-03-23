<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class cursoAcademicoValido implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cursoFinal = (int) substr($value, -2);
        $cursoInicial = (int) substr($value, 2, 2);
        $siglo = (int) substr($value, 0, 2);

        if($cursoInicial + 1 == $cursoFinal && $siglo == 20)
            return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Curso académico no válido.';
    }
}
