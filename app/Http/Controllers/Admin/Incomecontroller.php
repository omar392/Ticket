<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReply;
use App\Mail\ComplentMail;
use App\Mail\ReplyComplient;
use App\Models\Complaint;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class Incomecontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:incomes-read')->only(['index']);
        $this->middleware('permission:incomes-create')->only(['create', 'store']);
        $this->middleware('permission:incomes-update')->only(['edit', 'update']);
        $this->middleware('permission:incomes-delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Complaint::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function ($query) {
                    $users = $query->user()->first();
                    return $users->name;
                })
                ->editColumn('user_type', function ($query) {
                    $users = $query->user()->first();
                    return $users->user_type;
                })
                ->editColumn('department_id', function ($query) {
                    $departments = $query->department()->first();
                    return $departments->name;
                })
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
                    if (Auth::guard('admin')->user()->hasPermission('incomes-update')){
                    $Btn = '<a href="' .route("incomes.edit", $row->id). '"><button type="button"
                    class="delete btn btn-success fa fa-edit" data-size="sm" title="Edit"></button></a> &nbsp';
                    }
                    if (Auth::guard('admin')->user()->hasPermission('incomes-read')){
                    $Btn = $Btn.'<a href="' .route("incomes.show", $row->id). '"><button type="button"
                    class="delete btn btn-info fa fa-eye" data-size="sm" title="Edit"></button></a> &nbsp';
                    }
                    return $Btn;
                })

                ->rawColumns(['action','active'])
                ->make(true);

        }
        return view('admin.incomes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $complaint = Complaint::find($id);
        $replies = Reply::where('complaint_id',$id)->get();
        return view('admin.incomes.show',compact(['complaint','replies']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('admin.incomes.edit',compact('complaint'));
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
        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'status'       => $request->input('status'),
        ]);
        $complaint->save();
        return response()->json(['status'=>'success','data'=>$complaint]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function complaintReplyAdmin(Request $request)
    {

        $rules = [
            'title'=>'required',
            'description'=>'required',
           ];

           $validator = Validator::make($request->all()  ,$rules );

           if ($validator->fails())
           {
               return response()->json(['status'=>'fails','errors'=>$validator->errors()->all()]);
           }

        $reply = Reply::create([
            'writer'   => $request->input('writer'),
            'complaint_id'   => $request->input('complaint_id'),
            'title'   => $request->input('title'),
            'description'   => $request->input('description'),
            // 'attached'   => $request->input('attached'),
        ]);

        if($request->hasfile('attached'))
        {
           foreach($request->file('attached') as $file)
           {
               $name = time().'.'.$file->extension();
               $file->move(public_path().'/files/', $name);
               $data[] = $name;
           }
            $reply->attached=implode('|',$data);
            $reply->save();
        }else{
            $reply->save();
        }
        //
        $com = Complaint::where('id',$request->complaint_id)->first();
        // dd($com->user_id);
        $use = User::where('id',$com->user_id)->first();
        // dd($use->email);
        //
        Mail::to([$use->email])->send(new ReplyComplient($reply));
        return response()->json(['status' => 'success', 'data' => $reply]);
    }
}
