<?php

namespace Database\Factories;

use App\Models\OperationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operation>
 */
class OperationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence('3'),
            'op_date'=>$this->faker->dateTime(),
            'description'=>$this->faker->randomHtml(),
            'operation_type_id'=>OperationType::factory(),
            'isCompleted'=>random_int(0,1)
        ];
    }
}
