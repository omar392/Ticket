<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:users-read')->only(['index']);
        $this->middleware('permission:users-create')->only(['create', 'store']);
        $this->middleware('permission:users-update')->only(['edit', 'update']);
        $this->middleware('permission:users-delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return Datatables::of($data)
                ->addIndexColumn()

                // ->editColumn('department_id', function ($query) {
                //     $departments = $query->department()->first();
                //     return $departments->name;
                // })

                ->addColumn('action', function($row){
                    if (Auth::guard('admin')->user()->hasPermission('users-update')){
                        $Btn = '<a href="' .route("users.edit", $row->id). '"><button type="button"
                        class="edit btn btn-success fa fa-edit" data-size="sm" title="Edit"></button></a> &nbsp';
                    }
                    if (Auth::guard('admin')->user()->hasPermission('users-delete')){
                    $Btn = $Btn.'<form class="delete"  action="' . route("users.destroy", $row->id) . '"  method="POST" id="sa-params"
                    style="display: inline-block; right: 50px;" >
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="delete btn btn-danger fa fa-trash" title=" ' . 'Delete' . ' "></button>
                        </form>';
                    }
                    return $Btn;
                })
                ->rawColumns(['action','action'])
                ->make(true);
        }
        $departments = Department::get();
        return view('admin.users.index',compact('departments'));
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
        $rules = [
        'user_type' => 'required',
        'name'=>'required|string',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone',
        'email' => 'required|unique:users',
        'password' => 'required',
        ];
        $validator = Validator::make($request->all()  ,$rules );

        if ($validator->fails())
        {
            return response()->json(['status'=>'fails','errors'=>$validator->errors()->all()]);
        }
        $user = User::create([
            'user_type'   => $request->input('user_type'),
            'phone'   => $request->input('phone'),
            'name'   => $request->input('name'),
            'email'   => $request->input('email'),
            'password' => Hash::make($request->password),
            'code' => rand(1111, 9999),
        ]);

        // $request->merge([
        // 'password' => Hash::make($request->password),
        // 'user_type' => $request->user_type,
        // 'code' => rand(1111, 9999),
        // ]);
        $user->save();
        return response()->json(['status' => 'success', 'data' => $user]);
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
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
                'name'       => $request->input('name'),
                'email'       => $request->input('email'),
                'phone'       => $request->input('phone'),
                // 'user_type'   => $request->input('user_type'),
                'password' => Hash::make($request->input('password')),
                'code' => rand(1111, 9999),
        ]);

        $user->save();
        return response()->json(['status'=>'success','data'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => 'success']);
    }
}
