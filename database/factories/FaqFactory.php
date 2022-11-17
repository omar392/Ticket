<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Faq::class;
    public function definition()
    {
        return [
            'question_ar'=>$this->faker->sentences(1,true),
            'question_en'=>$this->faker->sentences(1,true),
            'answer_ar'=>$this->faker->sentences(6,true),
            'answer_en'=>$this->faker->sentences(6,true),
        ];
    }
}
