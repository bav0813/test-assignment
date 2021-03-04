<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Business;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function getBusinesses()
    {

        $list=Business::orderByDesc('created_at')
            ->paginate(15);

        if ($list) {
            return response()->json(["success" => true, 'list_of_businesses'=>$list],200);
        } else
            return response()->json(["success" => false, 'message'=>'not found'],404);
    }

    public function getBusiness($id)
    {

        $list=Business::orderByDesc('created_at')
            ->where('id', '=', $id)
            ->first();
        if ($list) {
            return response()->json(["success" => true, 'list_of_businesses'=>$list],200);
        } else
            return response()->json(["success" => false, 'message'=>'not found'],404);

    }

    public function deleteBusiness($id)
    {
        $business=Business::find($id);
        if ($business) {
            $res = $business->delete();

            if ($res) {
                return response()->json(["success" => true, 'message' => 'business deleted'],200);
            }
        }
        return response()->json(["success" => false, 'message' => 'business not found'],404);

    }


    public function storeBusiness(Request $request)
    {

        $validator=Validator::make($request->all(), [
            'name'  => 'required | between:10,50',
            'price' => 'required | integer | between:10000,10000000',
            'city'  => 'required',
        ]);

        if ($validator->fails()) {
            return  response()->json(["success" => false, 'message' => 'error creating business. Please check all required fields'],400);
        }

        $business=new Business();
        $business->name=$request->name;
        $business->price=$request->price;
        $business->city=$request->city;

        DB::beginTransaction(); //Start transaction!
        try {
        $business->save();
            // Commit Transaction
            DB::commit();
            return response()->json(["success" => true, 'message' => 'business created'],201);

        } catch (\Exception $e) {
            // failed logic here
            DB::rollback();
            return  response()->json(["success" => false, 'message' => 'error creating business. Please check all the required fields'],400);
        }

    }

    public function updateBusiness(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'id'  => 'required',
            'name'  => 'required | between:10,50',
            'price' => 'required | integer | between:10000,10000000',
        ]);

        if ($validator->fails()) {
            return  response()->json(["success" => false, 'message' => 'error creating business. Please check all the required fields'],400);
        }

            $business = Business::find($request->id);
            $business->city = $request->city ? $request->city : $business->getOriginal('city');
            $business->name = $request->name ? $request->name : $business->getOriginal('name');
            $business->price = $request->price ? $request->price : $business->getOriginal('price');

            DB::beginTransaction(); //Start transaction!
            try {
                $business->save();
                // Commit Transaction
                DB::commit();
                return response()->json(["success" => true, 'message' => 'business updated'],201);

            } catch (\Exception $e) {
                // failed logic here
                DB::rollback();
                return response()->json(["success" => false, 'message' => 'error updating business. Please check all the required fields'],400);
            }

    }
}
