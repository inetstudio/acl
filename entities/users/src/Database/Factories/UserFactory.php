<?php

namespace InetStudio\ACL\Users\Database\Factories;

use InetStudio\ACL\Users\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}
