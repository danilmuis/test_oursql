<?php

namespace App\Http\Controllers;

use Validator;
use DataTables;
use App\Models\Method;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::all()->toJson(JSON_PRETTY_PRINT);
        return response($subject, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        // echo route('dashboard');
        // return 1;
        if ($request->ajax()) {
            $data = Subject::select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="edit/'. $row->id .'" class="edit btn btn-primary btn-sm">Edit</a>
                           <a href="delete/'.$row->id.'" class="edit btn btn-danger btn-sm">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'subjectName'   => 'required',
            'startDate'     => 'required',
            'endDate'       => 'required',
            'idMethod'      => 'required',
        ]);
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            $method = Method::find($request->idMethod);
            if (!$method){
                return response()->json([
                    "message" => "method unavailable"], 500);
            }
            $subject = new Subject();
            $subject->subjectName = $request->subjectName;
            $subject->startDate = $request->startDate;
            $subject->endDate = $request->endDate;
            $subject->idMethod = $request->idMethod;
            $subject->save();
            return response()->json([
                "message" => "method added"], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $subject = Subject::withTrashed()->where('id', $id)->restore();
        if ($subject) {
            return response()->json([
                "message" => "restoring subject success"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Subject::where('id', $id)->exists()) {
            $validateData = Validator::make($request->all(), [
                'subjectName'   => '',
                'startDate'     => '',
                'endDate'       => '',
                'idMethod'      => '',
            ]);
            if ($validateData->fails()) {
                return response($validateData->errors(), 400);
            } else {
                $subject = Subject::find($id);
                $subject->subjectName = $request->subjectName == null ? $subject->subjectName : $request->subjectName;
                $subject->startDate = $request->startDate == null ? $subject->startDate : $request->startDate;
                $subject->endDate = $request->endDate == null ? $subject->endDate : $request->endDate;
                $subject->idMethod = $request->idMethod == null ? $subject->idMethod : $request->idMethod;
                $subject->save();
                return response()->json([
                    "message" => "subject updated"], 201);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            return response()->json([
                "message" => "subject not found"], 404);
        }
        $subject->delete();    
        return response()->json([
            "message" => "subject deleted"], 201);
    }
}
