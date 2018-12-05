<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Person;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PersonController extends BaseController
{
    public function welcome() {
        $data["people"] = Person::with('locations')->get();
        return view('welcome', $data);
    }

    public function index()
    {
        return $this->successResponse("people", Person::all());
    }

    public function store(Request $request)
    {
        $person = $request->all();
        $rules = [
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
        ];
        $validator = Validator::make($person, $rules);

        if($validator->fails()) {
            return $this->errorResponse('bad_request', 401);
        } else {
            DB::beginTransaction();
            try {
                $user =  User::create([
                    'email'     => $person['email'],
                    'password'  => Hash::make($person['password']),
                ]);
                $person = Person::create([
                    'name'          => $person['name'],
                    'last_name'     => $person['last_name'],
                    'user_id'       => $user->id
                ]);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return $this->errorResponse($exception->getMessage(), 500);
            }
        }
        return $this->successResponse('person created', $person);
    }


    public function show($id)
    {
        try {
            $person = Person::findOrFail($id);
        } catch (\Exception $e) {
            return $this->errorResponse('server_error', 500);
        }
        return $this->successResponse('person found', $person);
    }

    public function update(Request $request, $id)
    {
        $person = $request->all();
        $rules = [
            'name'      => 'required',
            'last_name' => 'required'
        ];
        $validator = Validator::make($person, $rules);

        if($validator->fails()) {
            return $this->errorResponse('bad_request', 401);
        } else {
            DB::beginTransaction();
            try {
                $person = Person::findOrFail($id);
                $person->update([
                    'name'          => $person['name'],
                    'last_name'     => $person['last_name']
                ]);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return $this->errorResponse($exception->getMessage(), 500);
            }
        }
        return $this->successResponse('person updated', $person);
    }

    public function destroy($id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->destroy();
        } catch (\Exception $e) {
            return $this->errorResponse('server_error', 500);
        }
        return $this->successResponse('person deleted', $person);
    }
}
