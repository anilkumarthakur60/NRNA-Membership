<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {$array = ['Male','Female','Other'];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('aaaassss'), // password
            'remember_token' => Str::random(10),
            'street_address' => $this->faker->name(),
            'apartment' => $this->faker->name(),
            'city' => $this->faker->name(),
            'provience' => $this->faker->name(),
            'zip_code' => $this->faker->name(),
            'country' => $this->faker->name(),
            'status' => $this->faker->name(),
            'total' => $this->faker->name(),
            'phone' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['Male', 'Female','Other']),
            'profession' => $this->faker->name(),
            'dob' => $this->faker->date('Y-m-d',now()),
            'highest_degree' => $this->faker->name(),
            'area_of_expertise' => $this->faker->name(),
            'year_of_experience' => $this->faker->name(),
            'referal_code' => $this->faker->name(),




        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
