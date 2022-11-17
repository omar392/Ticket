<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmin;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admins-read')->only(['index']);
        $this->middleware('permission:admins-create')->only(['create', 'store']);
        $this->middleware('permission:admins-update')->only(['edit', 'update']);
        $this->middleware('permission:admins-delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::whereHas('roles', function ($query) {
                $query->where('name', '!=', 'super_admin');
            });
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('role_id', function ($query) {
                $roles = $query->roles()->first();
                return $roles->name;
            })
            ->addIndexColumn()
            ->editColumn('department_id', function ($query) {
                $departments = $query->departments()->first();
                return $departments->name;
            })
            ->addColumn('action', function ($row) {
                if (Auth::guard('admin')->user()->hasPermission('admins-update')){
                    $btn ='<a href="' .route("admins.edit", $row->id). '"><button type="button"
                    class="edit btn btn-success fa fa-edit" data-size="sm" title="Edit"></button></a> &nbsp';
                }
                if (Auth::guard('admin')->user()->hasPermission('admins-delete')){
                    $btn = $btn.
                    '<form class="delete"  action="' . route("admins.destroy", $row->id) . '"  method="POST" id="sa-params"
                    style="display: inline-block; right: 50px;" >
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="delete btn btn-danger fa fa-trash" title=" ' . 'Delete' . ' "></button>
                        </form>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      $roles = Role::whereRoleNot(['super_admin'])->get();
      $departments = Department::where(['active'=>1])->get();
      return view('admin.admins.index', compact(['roles','departments']));
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
            'name' => 'required',
            'image' => 'nullable',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'role_id' => 'required',
            'department_id' => 'required',
            ];
            $validator = Validator::make($request->all()  ,$rules );

            if ($validator->fails())
            {
                return response()->json(['status'=>'fails','errors'=>$validator->errors()->all()]);
            }
            $admin = Admin::create([
                'name'   => $request->input('name'),
                'email'   => $request->input('email'),
                'department_id'   => $request->input('department_id'),
                'role_id'   => $request->input('role_id'),
                'password' => Hash::make($request->password),
            ]);
            $admin->attachRoles([$request->role_id]);
            $admin->save();
            return response()->json(['status' => 'success', 'data' => $admin]);
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
        $roles = Role::WhereRoleNot(['super_admin'])->get();
        $departments = Department::where(['active'=>1])->get();
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact(['roles', 'admin','departments']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdmin $request, $id)
    {

        $admin = Admin::findOrFail($id);
        $admin->update([
                'name'       => $request->input('name'),
                'email'       => $request->input('email'),
                'role_id'       => $request->input('role_id'),
                'department_id'       => $request->input('department_id'),
                'password' => Hash::make($request->input('password')),
        ]);
        $admin->syncRoles([$request->role_id]);
        $admin->save();
        return response()->json(['status'=>'success','data'=>$admin]);

        // $admin = Admin::findOrFail($id);
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',Rule::unique('admins')->ignore($admin->id),
        //     ],
        //     'role_id' => 'required',
        // ]);
        // $request->merge(['password' => bcrypt($request->password)]);
        // $admin->update($request->all());
        // $admin->syncRoles([$request->role_id]);
        // return response()->json(['status' => 'success', 'data' => $admin]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return response()->json(['status' => 'success']);
    }
}
