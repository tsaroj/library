<?php

namespace Database\Factories;

use App\Models\Borrow;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Borrow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bookdetail_id' => \App\Models\BookDetail::pluck('id')->random(),
            'student_id' => \App\Models\Student::pluck('id')->random(),
            'borrow_date' => $this->faker->dateTimeThisYear($max = 'now'),
            'due_date' => $this->faker->dateTimeInInterval( $startDate = '2 months'),
            'returned' => $this->faker->numberBetween($min = 0, $max = 1),
            'return_date' => $this->faker->dateTimeThisYear($max = 'now'),
            'issued_by' => \App\Models\User::pluck('id')->random(),
            // dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Antartica/Vostok')

        ];
    }
}
