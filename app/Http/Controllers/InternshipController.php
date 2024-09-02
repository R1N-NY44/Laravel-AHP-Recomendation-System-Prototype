<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\InternshipRequest;
use App\Models\Internship;
use Exception;
use Illuminate\Http\Request;

class InternshipController extends Controller
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
    public function store(InternshipRequest $request)
    {        
        
        try {            
            $associatedCourses = [];
            foreach ($request->criteria as $criteria) {
                $associatedCourses[] = [
                    $criteria['course'] => $criteria['weight'],  
                ];
            }                        
            // Store the internship data
            Internship::create([
                'name' => $request->name,
                'associated_course' => json_encode($associatedCourses),
                'status' => true
            ]);

            return Response::success(null, 'Lowongan berhasil ditambahkan');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Internship $internship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Internship $internship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InternshipRequest $request, Internship $internship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internship $internship)
    {
        //
    }
}
