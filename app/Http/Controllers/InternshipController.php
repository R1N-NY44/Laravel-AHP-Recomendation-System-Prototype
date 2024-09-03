<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\InternshipRequest;
use App\Models\Course;
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
    public function show($id)
    {
        // Fetch the internship based on the ID
        $internship = Internship::where('id_internship', $id)->first();
        
        if (!$internship) {
            return response()->json(['error' => 'Internship not found'], 404);
        }

         // Decode the associated courses and weights from JSON
         $criteria = json_decode($internship->associated_course, true);

         // Extract course IDs from criteria
         $courseIds = array_map(function ($item) {
             return key($item); // Get course ID
         }, $criteria);
 
         // Fetch course details where course ID is in the list
         $courses = Course::whereIn('id_course', $courseIds)->get();
 
         // Create a map of course ID to course name
         $courseMap = $courses->pluck('name', 'id_course')->toArray();
 
         // Prepare data to send in the response
         $response = [
             'criteria' => array_map(function ($item) use ($courseMap) {
                 // Map the JSON data to a format suitable for your repeater
                 return [
                     'course_id' => key($item), // Course ID
                     'course_name' => $courseMap[key($item)], // Course Name
                     'weight' => reset($item)   // Weight
                 ];
             }, $criteria)
         ];


        return response()->json($response);
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
