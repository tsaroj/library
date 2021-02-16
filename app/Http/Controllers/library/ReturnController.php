<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BookDetail;
use App\Models\Student;
use App\Models\Borrow;
Use Alert;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($book_code  = null)
    {   
        $isMaxBook = false;
        $borrowed = null;
        $borrowDetails =array();
        $maxBook = null;
        
        if ($book_code != null) {
           $borrowedBook = Borrow::find($book_code);
           if ($borrowedBook) {
                $borrowed = ['id'=>$borrowedBook['id'],'bookdetails_id'=>$borrowedBook['bookdetails_id'],'student_id'=>$borrowedBook['student_id'],'issued_by'=>$borrowedBook['issued_by'],'isReturned'=>$borrowedBook['isReturned']];
               $borrowDetails =Borrow::with('book_detail.book','student')->where(['student_id'=>$borrowedBook['student_id'],'returned'=>0])->get();
               $maxBook =Borrow::where(['student_id'=>$borrowedBook['student_id'],'returned'=>0])->count();
               $isMaxBook = ($maxBook >= 5)?1:0;
           }
        }

        return view('library.return.index',compact('isMaxBook','borrowed','borrowDetails'));
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
        // 
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
        $borrow = Borrow::where(['id'=>$id,'returned'=>0])->count();
        if ($borrow == 1 ) {
            Borrow::where('id',$id)->update(['returned' => 1]);
            return response()->json(['status'=>1,'data'=>"Book has been returned"]);
        }else if( $borrow == 0 )
        {
            return response()->json(['status'=>1,'data'=>'']);
        }
        
    }

    public function getBooks(Request $request, $id)
    {
        $searchBooks = BookDetail::where('book_code',$id)->first();
        if ($searchBooks) {
            $search = Borrow::where(['bookdetail_id'=>$searchBooks->id,'returned'=>0])->get();
            $count = $search->count();
            if ($count ==1) {
                return response()->json(['status'=>1,'data'=>$search[0]]);
            }else if($count ==0)
            {
                return response()->json(['status'=>1,'data'=>0]);
            }
        }
        
        return response()->json(['status'=>0,'data'=>'']);
    }
}
