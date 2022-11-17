<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqs;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:faqs-read')->only(['index']);
        $this->middleware('permission:faqs-create')->only(['create', 'store']);
        $this->middleware('permission:faqs-update')->only(['edit', 'update']);
        $this->middleware('permission:faqs-delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::get();
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
                    if (Auth::guard('admin')->user()->hasPermission('faqs-update')){
                    $Btn = '<a href="' .route("faqs.edit", $row->id). '"><button type="button"
                    class="delete btn btn-success fa fa-edit" data-size="sm" title="Edit"></button></a> &nbsp';
                    }
                    if (Auth::guard('admin')->user()->hasPermission('faqs-delete')){
                    $Btn = $Btn.'<form class="delete"  action="' . route("faqs.destroy", $row->id) . '"  method="POST" id="sa-params"
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
        return view('admin.faqs.index');
    }

    public function faqsStatus(Request $request)
    {
        $faqs = Faq::find($request->faqs_id);
        $faqs->active = $request->active;
        $faqs->save();
        return response()->json(['status' => 'success', 'data' => $faqs]);
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
    public function store(StoreFaqs $request)
    {
        $faqs = Faq::create([
            'question_ar'   => $request->input('question_ar'),
            'question_en'   => $request->input('question_en'),
            'answer_ar'   => $request->input('answer_ar'),
            'answer_en'   => $request->input('answer_en'),

        ]);
        $faqs->save();
        return response()->json(['status'=>'success','data'=>$faqs]);
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
        $faqs = Faq::findOrFail($id);
        return view('admin.faqs.edit',compact('faqs'));
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
        $faqs = Faq::findOrFail($id);
        $faqs->update([
            'question_ar'   => $request->input('question_ar'),
            'question_en'   => $request->input('question_en'),
            'answer_ar'   => $request->input('answer_ar'),
            'answer_en'   => $request->input('answer_en'),
        ]);

        $faqs->save();
        return response()->json(['status'=>'success','data'=>$faqs]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faqs = Faq::findOrFail($id);
        $faqs->delete();
        return response()->json(['status'=>'success']);
    }
}
