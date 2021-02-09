<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Book;
use App\models\BookDetail;

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
      $this->validate($request, [
        'title' => 'required',
        'author' => 'required',
        'publication' => 'required',
        'category'=>'required',
        "book_code"  => "required|min:6|max:6",
        "edition"  => "required",
        "price"  => "required",
        // ".*.book_code"  => "required|min:6|max:6",
        // ".*.edition"  => "required",
        // ".*.price"  => "required",
     ]);

        if (Book::where([
            ['title', '=', $request->title],
            ['author', '=', $request->author],
            ['publication', '=', $request->publication],
            ['category', '=', $request->category],
        ])) {
            $books = Book::where([
                    ['title', '=', $request->title],
                    ['author', '=', $request->author],
                    ['publication', '=', $request->publication],
                    ['category', '=', $request->category],
                ])->get();

                foreach ($request->addmore as  $value) {

                    $bookDetails = new BookDetail();
                    $bookDetails->book_id = $books[0]->id;
                    $bookDetails->book_code = $value['book_code'];
                    $bookDetails->price = $value['price'];
                    $bookDetails->edition = $value['edition'];
                    $bookDetails->save();
                }
            
                
                return back()->with('success', 'Your form has been submitted.');
        } else {
            $books->title = $request->title;
            $books->author = $request->author;
            $books->publication = $request->publication;
            $books->category = $request->category;
            $books->save();
            foreach ($request->addmore as  $value) {

                $bookDetails = new BookDetail();
                $bookDetails->book_id = $books->id;
                $bookDetails->book_code = $value['book_code'];
                $bookDetails->price = $value['price'];
                $bookDetails->edition = $value['edition'];
                $bookDetails->save();
            }
        
            
            return back()->with('success', 'Your form has been submitted.');
        
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
        // return $book;
        return view('library/book/bookDetails', compact('book'));
    }

    public function bookDetails_store(Request $request)
    {
        // return $request;

        $this->validate($request, [
        //   "addmore"=>'required|min:3',
          'addmore.*.book_code' =>'required|min:6|max:6',
            // "addmore.book_code"  => "required|min:6|max:6",
            // "addmore.edition"  => "required",
            // "addmore.price"  => "required",
         ]);
        $book_id = $request->id;
        foreach ($request->addmore as  $value) {
            $bookDetails = new BookDetail;
            $bookDetails->book_id = $book_id;
            $bookDetails->book_code = $value['book_code'];
            $bookDetails->price = $value['price'];
            $bookDetails->edition = $value['edition'];
            $bookDetails->save();
        }
        return redirect()->route('book.index');
    


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
        // return $id;
        
        $bookDetails = Book::with('bookDetails')->findOrFail($id);
        // return $bookDetails;
        return view('library.book.BooksDetails',compact('bookDetails'));
        //return redirect()->route('book.details.view',compact('bookDetails'));
      
    }

   
}
