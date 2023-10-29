<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => User::factory()->create()->id,
            'meeting_topic' => $this->faker->sentence(),
            'meeting_room_name' => $this->faker->sentence(),
            'meeting_date' =>  $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'meeting_time' =>  $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'speaker' => random_int(0,1),
            'notebook' => random_int(0,1),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'contact_name' => $this->faker->name(),
            'contct_number' => $this->faker->sentence(),
            'institution' => $this->faker->sentence(),
            'เลขที่หนังสือ' => $this->faker->sentence(),
            'status' => rand(1,3),
        ];
    }
}
