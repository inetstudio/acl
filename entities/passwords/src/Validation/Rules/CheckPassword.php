<?php

namespace InetStudio\ACL\Passwords\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use InetStudio\ACL\Passwords\Contracts\Validation\Rules\CheckPasswordContract;

/**
 * Class CheckPassword.
 */
class CheckPassword implements CheckPasswordContract, Rule
{
    /**
     * @var string
     */
    protected $currentHash;

    /**
     * CheckPassword constructor.
     *
     * @param  string  $currentHash
     */
    public function __construct(string $currentHash)
    {
        $this->currentHash = $currentHash;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value == '' || Hash::check($value, $this->currentHash);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Поле содержит неверное значение';
    }
}
