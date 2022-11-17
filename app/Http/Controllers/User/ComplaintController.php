<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaint;
use App\Http\Requests\StoreReply;
use App\Models\Complaint;
use App\Models\Department;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Helpers\Helper;
use App\Models\Setting;
use App\Mail\ComplentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $id = auth()->user()->id;
            $complaints = Complaint::where('user_id', $id)->get();
            return Datatables::of($complaints)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("complaint.show", $row->id) . '" class="edit btn btn-primary btn-sm fa fa-eye"></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $departments = Department::get();
        $users = User::get();
        return view('users.complaint.index', compact(['departments', 'users']));
    }
    public function store(Request $request)
    {
        $setting = Setting::findOrFail(1);
        $awn = $setting->AWN;

        $id = auth()->user()->id;
        // $email = auth()->user()->email;

        $rules = [
         'department_id'=>'required',
         'title'=>'required',
         'description'=>'required',
        ];

        $validator = Validator::make($request->all() ,$rules);

        if ($validator->fails())
        {
            return response()->json(['status'=>'fails','errors'=>$validator->errors()->all()]);
        }

        $complaint = Complaint::create([
            'user_id'   => $request->input('user_id'),
            'department_id'   => $request->input('department_id'),
            'title'   => $request->input('title'),
            'description'   => $request->input('description'),
            // 'attached'   => $request->input('attached'),
            'complaint_id'   => Helper::IDGenerator(new Complaint, 'complaint_id', 5, $awn),

        ]);
        if ($request->hasfile('attached')) {
            foreach ($request->file('attached') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
            $complaint->attached = implode('|', $data);
            $complaint->save();
        }else{
            $complaint->save();
        }



        Mail::to(['omarabosamaha@gmail.com'])->send(new ComplentMail($complaint));


    return response()->json(['status' => 'success', 'data' => $complaint]);
    }

    public function show($id)
    {

        $complaint = Complaint::find($id);

        if($complaint->user_id != auth()->id()){
            abort(code:403);
        }



        $replies = Reply::where('complaint_id', $id)->get();

        // dd($replies);
        return view('users.complaint.show', compact(['complaint', 'replies']));
    }

    public function complaintReply(Request $request)
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


        if ($request->hasfile('attached')) {
            foreach ($request->file('attached') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
            $reply->attached = implode('|', $data);
            $reply->save();
        }else{
            $reply->save();
        }

        Mail::to(['omarabosamaha@gmail.com'])->send(new ComplentMail($reply));

        return response()->json(['status' => 'success', 'data' => $reply]);
    }
}
