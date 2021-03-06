<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Borrow;
use app\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $response = Http::get('http://192.168.254.8:8000/api/allstudents');
        $response = json_decode($response,true);
        return view('library.student.index',compact('response'));
    }
    public function getAllStudents()
    {


        $response = Http::get('http://192.168.254.8:8000/api/allstudents');
        return $response;
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
        $url = 'http://192.168.254.8:8000/api/students/'.$id;
        $dataStudent = Http::get($url);
        $dataStudent = json_decode($dataStudent,true);
        $books = Borrow::with('book_detail.book','user')->where(['student_id'=>$dataStudent['id'],'returned'=>0])->get();
        // $books = Borrow::with('user')->where(['student_id'=>$dataStudent['id'],'returned'=>0])->get();
        // return$books;
        return view('library.student.show',compact('dataStudent','books'));
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
}
