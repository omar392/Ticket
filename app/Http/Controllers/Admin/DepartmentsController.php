<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:departments-read')->only(['index']);
        $this->middleware('permission:departments-create')->only(['create', 'store']);
        $this->middleware('permission:departments-update')->only(['edit', 'update']);
        $this->middleware('permission:departments-delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Department::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('active', function ($query) {
                    if ($query->active) {
                        $btn = '
                        <div class="container">
                        <label class="switch">
                          <input type="checkbox" data-id="' . $query->id . '" type="checkbox" id="check"  checked>
                          <div class="slider round"></div>
                        </label>
                      </div>
                      ';

                    } else {
                        $btn = '
                        <div class="container">
                        <label class="switch">
                          <input type="checkbox" data-id="' . $query->id . '" type="checkbox" id="check">
                          <div class="slider round"></div>
                        </label>
                      </div>
                      ';
                    }
                 return $btn;
                })

                ->addColumn('action', function($row){
                    if (Auth::guard('admin')->user()->hasPermission('departments-update')){
                    $Btn = '<a href="' .route("departments.edit", $row->id). '"><button type="button"
                    class="delete btn btn-success fa fa-edit" data-size="sm" title="Edit"></button></a> &nbsp';
                    }
                    if (Auth::guard('admin')->user()->hasPermission('departments-delete')){
                    $Btn = $Btn.'<form class="delete"  action="' . route("departments.destroy", $row->id) . '"  method="POST" id="sa-params"
                    style="display: inline-block; right: 50px;" >
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="delete btn btn-danger fa fa-trash" title=" ' . 'Delete' . ' "></button>
                        </form>';
                    }
                    return $Btn;
                })
                ->rawColumns(['action','active'])
                ->make(true);
        }
        return view('admin.departments.index');
    }

    public function departmentsStatus(Request $request)
    {
        $department = Department::find($request->department_id);
        $department->active = $request->active;
        $department->save();
        return response()->json(['status' => 'success', 'data' => $department]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['name_ar' => 'required|string' , 'name_en'=>'required|string'];

        $validator = Validator::make($request->all()  ,$rules );

        if ($validator->fails())
        {
            return response()->json(['status'=>'fails','errors'=>$validator->errors()->all()]);
        }
        $department = Department::create([
            'name_ar'   => $request->input('name_ar'),
            'name_en'   => $request->input('name_en'),
        ]);

        $department->save();
        return response()->json(['status'=>'success','data'=>$department]);
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
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartment $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->update([
                'name_ar'       => $request->input('name_ar'),
                'name_en'       => $request->input('name_en'),
        ]);

        $department->save();
        return response()->json(['status'=>'success','data'=>$department]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(['status'=>'success']);
    }
}
