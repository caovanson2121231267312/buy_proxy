<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Proxy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function index(Request $request) {
        try {
            $data = Proxy::where('status', 1)
                ->get();

            return response()->json([
                "data" => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function getlistproxy(Request $request) {

        $token = $request->token;
        $user = User::where('token', $token)->whereNotNull('email_verified_at')->first();


        try {
            $query = Order::select('id', 'end_date', 'payload')->where('user_id', $user->id);

            $data = $query->orderBy('id', 'desc')->get();

            $arr = [];
            foreach ($data as $order) {
                if ($order->payload) {
                    $payload = json_decode($order->payload);
                    $order->payload_data = json_decode($order->payload, true)['Data'];
                    $arr[] = $order->payload_data;
                }
            }

            return response()->json([
                "Status" => "Success",
                "Message" => "Thành công",
                "Data" => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
            ], 500);
        }
    }
}
