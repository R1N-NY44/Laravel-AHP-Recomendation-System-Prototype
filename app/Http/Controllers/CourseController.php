<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        try {            
            Course::create([
                'name' => $request->name,              
            ]);

            return Response::success(null, 'Course berhasil ditambahkan');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $courses = Course::all();
        
        return DataTables::of($courses)
            ->addIndexColumn()   
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-primary'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })         
            ->addColumn('action', function ($row) {                               
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "primary";

                $url = route('course.status', $row->id_course);
                $btn = "<div class='text-center'><a data-bs-toggle='modal' data-id='{$row->id_course}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' data-function='afterUpdateStatus' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }   

    /**
     * Update the specified resource in storage.
     */
     public function edit(string $id)
    {
        $course = Course::where('id_course', $id)->first();
        return $course;
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        try {
            $course = Course::where('id_course', $id)->first();
            if (!$course) return Response::error(null, 'Course not found!');

            $course->name = $request->name;
            $course->update();        

            return Response::success(null, 'Course berhasil diupdate!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }  

    public function status($id)
    {
        try {
            $course = Course::where('id_course', $id)->first();
            $course->status = !$course->status;
            $course->save();

            return Response::success(null, 'Status Course berhasil diupdate!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
}
