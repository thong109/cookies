<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\FreeShip;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {
        $city = City::OrderBy('matp', 'asc')->get();
        return view('admin.delivery.delivery')->with(compact('city'));
    }

    public function fetchDelivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            // $output = '';
            if ($data['action'] == 'city') {
                $provinces = Province::where('matp', $data['ma_id'])
                    ->orderBy('maqh', 'asc')
                    ->get();
                return response()->json([
                    'provinces' => $provinces,
                ]);
            } else {
                $wards = Wards::where('maqh', $data['ma_id'])
                    ->orderBy('xaid', 'asc')
                    ->get();
                return response()->json([
                    'wards' => $wards,
                ]);
            }
        }
    }

    public function insertDelivery(Request $request)
    {
        $data = $request->all();

        $fee_ship = FreeShip::where('fee_matp', $data['city'])
            ->where('fee_maqh', $data['province'])
            ->where('fee_xaid', $data['wards'])
            ->delete();

        $fee_ship = new FreeShip();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }

    public function fetchFeeship()
    {
        $feeship = FreeShip::with('city', 'province', 'wards')
            ->orderBy('fee_id', 'desc')
            ->get();
        return response()->json([
            'data' => $feeship,
        ]);
    }

    public function updateDelivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = FreeShip::findOrFail($data['feeship_id']);
        // $fee_value = rtrim($data['fee_value'], '.');
        if (is_null($data['fee_value'])) {
            $data['fee_value'] = 20000;
        }
        $fee_ship->fee_feeship = $data['fee_value'];
        $fee_ship->save();
    }
}
