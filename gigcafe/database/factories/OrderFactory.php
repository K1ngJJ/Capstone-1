<?php
// Programmer Name: Ms. Lim Jia Yong, Project Manager
// Description: Creates dummy order data, read README.md for more info
// Edited on: 20 March 2022

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = Carbon::parse('2022-03-01');
        $today = Carbon::today()->toDateTimeString();
        return [
            'user_id' => $this->getUser(),
            'dateTime' => $this->faker->dateTimeBetween($startDate, $today),
            'completed' => true,
            'type' => $this->getType(),
        ];
    }

    // Return random customer
    private function getUser() {
        $index = 0;
        $totalUsers = User::count();
        while (true) {
            if ($index > $totalUsers * 3) return;
            $index++;
            $userID = random_int(1, $totalUsers);
            if (User::find($userID)->role == 'customer')
                return $userID;
        }
    }

    private function getType() {
        $options = array('dineIn', 'takeAway');
        $rand = array_rand($options);
        return $options[$rand];
    }
}
