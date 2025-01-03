<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckPaymentController extends Controller
{
    public function checkPayment(Request $request, $orderCode)
    {
        // Tìm đơn hàng theo mã đơn hàng
        $order = Order::where('order_code', $orderCode)->first();

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return response()->json([
                'invitation_code' => $order->order_code,
                'customer_id' => $order->user_id,
                'payment_status' => $order->payment_status
            ]);
        } else if ($order->payment_status == 'paid') {
            return response()->json([
                'invitation_code' => $order->order_code,
                'customer_id' => $order->user_id,
                'payment_status' => $order->payment_status
            ]);
        }

        $shipping_amount = $order->shipping_amount;
        $grand_total = $order->grand_total;

        if($order->payment_method == 'cod'){
            $transaction = Transaction::where('transaction_content', 'like', '%' . $orderCode . '%')
            ->where('amount_in', '=', ($order->deposit_amount)) // Kiểm tra amount_in
            ->first();
            if ($transaction) {
                // Cập nhật trạng thái thanh toán của order
                $order->update(['deposit_status' => 'paid']);
                return response()->json([
                    'invitation_code' => $order->order_code,
                    'customer_id' => $order->user_id,
                    'payment_status' => $order->deposit_status
                ]);
            }
        }else{
            // Lấy transaction dựa trên transaction_content chứa orderCode
            $transaction = Transaction::where('transaction_content', 'like', '%' . $orderCode . '%')
                ->where('amount_in', '=', ($shipping_amount + $grand_total)) // Kiểm tra amount_in
            ->first();
            if ($transaction) {
                // Cập nhật trạng thái thanh toán của order
                $order->update(['payment_status' => 'paid']);
                return response()->json([
                    'invitation_code' => $order->order_code,
                    'customer_id' => $order->user_id,
                    'payment_status' => $order->payment_status
                ]);
            }
        }
        // Kiểm tra nếu transaction tồn tại và điều kiện thanh toán


        return response()->json([
            'invitation_code' => $order->order_code,
            'customer_id' => $order->user_id,
            'payment_status' => $order->payment_status
        ]);
    }
}
