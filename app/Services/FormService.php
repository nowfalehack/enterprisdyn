<?php

namespace App\Services;

class FormService
{
    public function generateValidation($fields)
    {
        $rules = [];

        foreach ($fields as $field) {

            $rule = [];

            if ($field->required) $rule[] = 'required';

            switch ($field->type) {
                case 'email':
                    $rule[] = 'email';
                    break;
                case 'number':
                    $rule[] = 'numeric';
                    break;
            }

            $rules[$field->label] = implode('|', $rule);
        }

        return $rules;
    }
}

