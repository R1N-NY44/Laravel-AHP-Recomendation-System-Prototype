<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreValueRequest;
use App\Http\Requests\UpdateValueRequest;
use App\Http\Requests\ValueRequest;
use App\Models\Value;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValueRequest $request)
    {        
        try {
            $valueData = [];
            foreach ($request->candidate as $item) {
                $valueData[] = [
                    'nim' => $request->nim,
                    'id_internship' => $request->input('id_internship'),
                    'name' => $request->input('name'),
                    'ipk' => $request->input('ipk'),
                    'course_grades' => json_encode([[
                        $item['course'] => $item['weight']
                    ]]),
                    'status' => true
                ];
            }

            foreach ($valueData as $data) {
                Value::create($data);
            }

            return response()->json(['message' => 'Data Kandidat berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Value $value)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValueRequest $request, Value $value)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Value $value)
    {
        //
    }
}
