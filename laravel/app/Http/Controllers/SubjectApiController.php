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

    public function join(){
        $data = DB::table('subjects')
        ->join('methods', 'subjects.idmethod', '=', 'methods.id')
        ->select('methodname','subjectname', 'startdate', 'enddate')
        ->get();
        return response($data, 200);
    }

    public function table()
    {
        $data = DB::table('subjects')
        ->join('methods', 'subjects.idmethod', '=', 'methods.id')
        ->select('methodname','subjectname', 'startdate', 'enddate')
        ->get();
        return view('table',['data' => $data]);
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
            $i = 0;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $x = $row->id-1;
                           $btn = '<a class="edit btn btn-primary btn-sm" id="edit-detail" onClick="callInputModal(\''.$row->id.'\',\''.$row->subjectname.'\',\''.$row->startDate.'\',\''.$row->endDate.'\',\''.$row->idMethod.'\')">Edit</a>
                           <a class="edit btn btn-danger btn-sm">Delete</a>';
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
            'subjectname'   => 'required',
            'startdate'     => 'required',
            'enddate'       => 'required',
            'idmethod'      => 'required',
        ]);
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            $method = Method::find($request->idmethod);
            if (!$method){
                return response()->json([
                    "message" => "method unavailable"], 500);
            }
            $subject = new Subject();
            $subject->subjectname = $request->subjectname;
            $subject->startdate = $request->startdate;
            $subject->enddate = $request->enddate;
            $subject->idmethod = $request->idmethod;
            $subject->save();
            return response()->json([
                "message" => "subject added"], 201);
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
                'subjectname'   => '',
                'startdate'     => '',
                'enddate'       => '',
                'idmethod'      => '',
            ]);
            if ($validateData->fails()) {
                return response($validateData->errors(), 400);
            } else {
                $subject = Subject::find($id);
                $subject->subjectname = $request->subjectname == null ? $subject->subjectname : $request->subjectname;
                $subject->startdate = $request->startdate == null ? $subject->startdate : $request->startdate;
                $subject->enddate = $request->enddate == null ? $subject->enddate : $request->enddate;
                $subject->idmethod = $request->idmethod == null ? $subject->idmethod : $request->idmethod;
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
