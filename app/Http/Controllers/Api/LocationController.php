<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LocationController extends BaseController
{

    public function index()
    {
        return $this->successResponse("locations", Location::with('person')->get());
    }

    public function store(Request $request)
    {
        try {

            $location = $request->all();
            $rules = [
                'person_id'    => 'required',
                'longitude'    => 'required',
                'latitude'     => 'required',
            ];
            $validator = Validator::make($location, $rules);

            if($validator->fails()) {
                return $this->errorResponse('bad_request', 401);
            } else {
                $loc = Location::create([
                    'person_id'     => $location['person_id'],
                    'longitude'     => $location['longitude'],
                    'latitude'      => $location['latitude']
                ]);
            }
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
        return $this->successResponse('location created', $loc);
    }


    public function show($id)
    {
        try {
            $person = Location::with('person')->findOrFail($id);
        } catch (\Exception $e) {
            return $this->errorResponse('server_error', 500);
        }
        return $this->successResponse('location found', $person);
    }

    public function update(Request $request, $id)
    {
        $location = $request->all();
        $rules = [
            'longitude'  => 'required',
            'latitude'   => 'required'
        ];
        $validator = Validator::make($location, $rules);

        if($validator->fails()) {
            return $this->errorResponse('bad_request', 401);
        } else {
            DB::beginTransaction();
            try {
                $location = Location::findOrFail($id);
                $location->update([
                    'latitude'          => $location['latitude'],
                    'longitude'         => $location['longitude']
                ]);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return $this->errorResponse($exception->getMessage(), 500);
            }
        }
        return $this->successResponse('location updated', $location);
    }

    public function destroy($id)
    {
        try {
            $person = Location::findOrFail($id);
            $person->destroy();
        } catch (\Exception $e) {
            return $this->errorResponse('server_error', 500);
        }
        return $this->successResponse('location deleted', $person);
    }
}
