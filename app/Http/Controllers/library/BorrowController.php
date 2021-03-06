<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\BookDetail;
use Illuminate\Support\Facades\Http;
use App\Models\Borrow;
Use Alert;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student=null)
    {
        $isMaxBook = false;
        $studentD = null;
        $dataBook =array();
        $maxBook = null;
        if($student != null){
            
            $url = 'http://192.168.254.8:8000/api/students/'.$student;
            $dataStudent = Http::get($url);
            $student = json_decode($dataStudent,true);



            // $student = Student::find($student);
            if($student)
            {
                $studentD = ['id'=>$student['id'],'name'=>$student['name']];
                $dataBook = Borrow::with('book_detail.book')->where(['student_id'=>$studentD['id'],'returned'=>0])->get();
                $maxBook = Borrow::where(['student_id'=>$studentD['id'],'returned'=>0])->count();
                $isMaxBook = ($maxBook >= 5)?1:0;
            }
        }
        return view('library/borrow/index',compact('studentD','dataBook','isMaxBook'));
    }

    public function issuedBook()
    {
        $issuedBook = Borrow::with('book_detail.book','user')->where('returned',0)->get();
        // return $issuedBook;
        return view('library.borrow.borrowedBook',compact('issuedBook'));
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
        $req = $request->all();

        $validator = Validator::make($req, [
            'book_id' =>'required',
            'student_id'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>0,'msg'=>'Error message']);
        }

        $maxBook = Borrow::where(['student_id'=>$req['student_id'],'returned'=>0])->count();
        if(Borrow::where(['bookdetail_id'=>$req['book_id'],'returned'=>0])->count() > 0)
        {
            return response()->json(['status'=>0,'msg'=>'Book Access Code Already Issued']);
        }
        
    
        if ($maxBook <=5) {
                $today = \Carbon\Carbon::now();
                $dueday = $today->addDays(30);
        
                $borrow = new Borrow();
                $borrow->bookdetail_id = $req['book_id'];
                $borrow->student_id = $req['student_id'];
                $borrow->borrow_date = $today->toDateTimeString();
                $borrow->due_date = $dueday->toDateTimeString();
                $borrow->returned = 0;
                $borrow->return_date = $today->toDateTimeString();
                $borrow->issued_by = Auth()->user()->id;
                $borrow->status = 1;
                    if($borrow->save())
                    {
                        return response()->json(['status'=>1,'msg'=>'Book Issued Successfully']);
                    }        
                    else{
                        return response()->json(['status'=>0]);
                    }
        }else {
            return response()->json(['status'=>0,'msg'=>'The book limit is completed']);
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


    public function student_details($id)
    {

        //$dataStudent = Student::where(['id'=>$id])->get();
        $url = 'http://192.168.254.8:8000/api/students/'.$id;
        $dataStudent = Http::get($url);
        $dataStudent = json_decode($dataStudent,true);
        //return response()->json(['status'=>1,'data'=>$dataStudent]);
        if(!is_null($dataStudent))
        {
            return response()->json(['status'=>1,'data'=>$dataStudent]);
        }
        else{
            return response()->json(['status'=>1,'data'=>0]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    public function destroy($id)
    {
        //
    }

    public function getBooks(Request $request,$id)
    {
        $dataBook = BookDetail::with(['book','borrow'=>function($query){
            return $query->where('returned',0);
        }])->where(['book_code'=>$id])->get();

        if(count($dataBook) > 0)
        {
            if(empty($dataBook[0]->borrow)){
                return response()->json(['status'=>1,'data'=>$dataBook[0],'issued'=>0]);
            }
            elseif(count($dataBook[0]->borrow) == 1)
            {
                return response()->json(['status'=>1,'data'=>$dataBook[0],'issued'=>1]);
            }
            elseif(count($dataBook[0]->borrow) == 0)
            {
                return response()->json(['status'=>1,'data'=>$dataBook[0],'issued'=>0]);
            }
        }
        return response()->json(['status'=>0,'data'=>'','issued'=>0]);
    }
}
