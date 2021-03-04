<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Business;

class BusinessController extends Controller
{
    public function getBusinesses()
    {

        $list=Business::orderByDesc('created_at')
            ->paginate(15);

        if ($list) {
            return response()->json(["success" => true, 'list_of_businesses'=>$list]);
        } else
            return response()->json(["success" => false, 'message'=>'not found']);
    }

    public function getBusiness($id)
    {

        $list=Business::orderByDesc('created_at')
            ->where('id', '=', $id)
            ->first();
        if ($list) {
            return response()->json(["success" => true, 'list_of_businesses'=>$list]);
        } else
            return response()->json(["success" => false, 'message'=>'not found']);

    }

    public function deleteBusiness($id)
    {
        $business=Business::find($id);
        if ($business) {
            $res = $business->delete();

            if ($res) {
                return response()->json(["success" => true, 'message' => 'business deleted']);
            }
        }
        return response()->json(["success" => false, 'message' => 'business not found']);

    }

//    public function deleteBusiness($id)
//    {
//        $business=Business::find($id);
//        if ($business) {
//            $res = $business->delete();
//
//            if ($res) {
//                return response()->json(["success" => true, 'message' => 'business deleted']);
//            }
//        }
//        return response()->json(["success" => false, 'message' => 'business not found']);
//
//    }

    public function storeBusiness(Request $request)
    {
        $business=new Business();
        $business->name=$request->name;
        $business->price=$request->price;
        $business->city=$request->city;

        DB::beginTransaction(); //Start transaction!
        try {
        $business->save();
            // Commit Transaction
            DB::commit();
            return response()->json(["success" => true, 'message' => 'business created']);

        } catch (\Exception $e) {
            // failed logic here
            DB::rollback();
            return  response()->json(["success" => false, 'message' => 'error creating business. Please check all required fields']);
        }

    }

    public function updateBusiness(Request $request)
    {
        if ($request->id) {
            $business = Business::find($request->id);
            $business->city = $request->city ? $request->city : $business->getOriginal('city');
            $business->name = $request->name ? $request->name : $business->getOriginal('name');
            $business->price = $request->price ? $request->price : $business->getOriginal('price');

            DB::beginTransaction(); //Start transaction!
            try {
                $business->save();
                // Commit Transaction
                DB::commit();
                return response()->json(["success" => true, 'message' => 'business updated']);

            } catch (\Exception $e) {
                // failed logic here
                DB::rollback();
                return response()->json(["success" => false, 'message' => 'error updating business. Please check all required fields']);
            }
        } else  return response()->json(["success" => false, 'message' => 'error updating business. ID filed not found']);

    }
}
