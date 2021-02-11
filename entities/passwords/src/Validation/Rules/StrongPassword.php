<?php

namespace InetStudio\ACL\Passwords\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use InetStudio\ACL\Passwords\Contracts\Validation\Rules\CheckPasswordContract;

class StrongPassword implements CheckPasswordContract, Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@()$%^&*=_{}[\]:;\"'|\\<>,.\/~`±§+-]).{8,30}$/", $value);
    }

    public function message()
    {
        return 'Пароль должен быть длиной 8-30 символов, содержать хотя бы одно число, символ из списка #?!@()$%^&*=_{}[]:;"\'|\<>,./~`±§+-, строчную и заглавную букву';
    }
}
