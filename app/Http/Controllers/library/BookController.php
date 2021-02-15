<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\models\Book;
use App\models\BookDetail;
Use Alert;
use DB;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $books = Book::all();
        
        return view('library/book/index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('library/book/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Book $books)
    {

        // Form validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'publication' => 'required',
            'category'=>'required',
        ]);

// return $validator;
        if ($validator->fails()) {
            Alert::error('Oops....! ', 'Please enter the valid data in input field');
             return redirect()->back();
        } else {
            $book = Book::where([
                ['title', '=', $request->title],
                ['author', '=', $request->author],
                ['publication', '=', $request->publication],
                ['category', '=', $request->category],])->count();
            if ($book < 1) 
               { $books->title = $request->title;
                $books->author = $request->author;
                $books->publication = $request->publication;
                $books->category = $request->category;
                $books->save();
                Alert::success('Success ', 'Book is successfully added');
                return redirect()->route('book.index');
               
            }  
            else 
                {
                Alert::error('Oops....! ', 'Book Has been already added');
                return redirect()->route('book.index');

               

           

        }
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

    public function details($id)
    {
        $book =Book::findOrFail($id);
        return view('library/book/bookDetails', compact('book'));
    }

    public function bookDetails_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'addmore.*.book_code' =>'required|min:6|max:6|unique:book_details,book_code',
            'addmore.*.edition'  => 'required',
            'addmore.*.price'  => 'required',
        ]);
        
        if ($validator->fails()) {
            Alert::error('Oops....! ', 'Please enter the valid data in input field');
             return redirect()->back()->withInput($request->all());
        } else {
            $book_id = $request->id;
            foreach ($request->addmore as  $value) {
                $bookDetails = new BookDetail;
                $bookDetails->book_id = $book_id;
                $bookDetails->book_code = $value['book_code'];
                $bookDetails->price = $value['price'];
                $bookDetails->edition = $value['edition'];
                $bookDetails->save();
            }
            Alert::success('Success ', 'Books Details has been successfully added');
            return redirect()->route('book.index');
        }
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
        return $request;
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

    public function views($id,Request $request)
    {
        $book = Book::with('bookDetails')->findOrFail($id);
        // return $book;
        $newarr =[];
        foreach($book->bookDetails as $detail)
        {
            $newarr[$detail->edition]["price"] = $detail->price;
            $newarr[$detail->edition]["status"] = $detail->status;
            $newarr[$detail->edition]['book_codes'][] = $detail->book_code;
        }
        $book['editions'] = $newarr;
       
        return view('library.book.BooksDetails',compact('book'));
    }

   
    public function test()
    {
        return view ('library.book.test');
    }

   
}
