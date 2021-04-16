<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
class DummyController extends Controller
{
    //
    public function index(Request $request){
        
        if ($request->ajax()) {
            // $data = DB::table('dummy')->get();
            $i = 0;
            $conn = mysqli_connect('127.0.0.1','root','','bc');
            $sql = "SELECT * FROM dummy;";
            $result = mysqli_query($conn, $sql);
            $data = [];
            while($row = mysqli_fetch_assoc($result)) {
                $x = [
                    'id' => $row["id"], 
                    'data' => $row["data"]
                ];
                array_push($data,(object) $x);
            }
            return Datatables::of(($data))
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a class="edit btn btn-primary btn-sm" id="edit-detail" onClick="callInputModal(\''.$row->id.'\',\''.$row->data.'\')">Edit</a>
                           <a class="edit btn btn-danger btn-sm" onClick="deleteSubject(\''.$row->id.'\')">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard');
    }
    public function store(Request $request)
    {
       
        DB::insert('insert into dummy set data=?', [$request->data]);
        return response()->json([
            "message" => "dummy added"], 201);
        
    }

    public function update(Request $request,$id)
    {
       
        // DB::insert('insert into dummy set data=?', [$request->data]);
        DB::table('dummy')
        ->where('id',$id)
        ->update(['data' => $request->data]);
        return response()->json([
            "message" => "dummy updated"], 201);
        
    }
    public function destroy($id)
    {
        DB::table('dummy')->where('id', $id)->delete();
           
        return response()->json([
            "message" => "dummy deleted"], 201);
    }
}
