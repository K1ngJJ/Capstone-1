<?php
// Programmer Name: Ms. Lim Jia Yong, Project Manager
// Description: Creates dummy transaction data, read README.md for more info
// Edited on: 28 March 2022

namespace Database\Factories;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $order = Order::factory()->times(1)->create()->first();
        return [
            'order_id' => $order->id,
            'discount_id' => $this->getDiscount(),
            // change 'final_amount' value manually after creation of cart items with this code:
            // $transactions = Transaction::all();
            // foreach ($transactions as $t) {
            //     $t->final_amount = $t->order->getTotalFromScratch();
            //     $t->save();
            // }
            // just change in tinker will do
            'final_amount' => $this->faker->randomFloat(2, 1, 999),
            'created_at' => $order->dateTime,
        ];
    }

    private function getDiscount() {
        if (rand(0, 1)) {
            $count = 0;
            $numDiscounts = Discount::count();
            while (true) {
                if ($count > $numDiscounts * 2)
                    return null;
                $count++;
                $index = $this->faker->numberBetween(1, $numDiscounts);
                if (Discount::find($index) != null)
                    return $index;
            }
        } else
            return null;
    }
}
