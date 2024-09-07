<?php
namespace App\Services\Orders;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class SaveOrderService
{
    public static function createOrder($userId, Product $product, $quantity)
    {
        $totalPrice = $product->price * $quantity;

        // Save the order in the database
        return Order::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);
    }

}
