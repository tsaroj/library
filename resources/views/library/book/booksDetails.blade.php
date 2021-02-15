@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <div class="card-title">
              Book Details Informations
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('img/default_book.png') }}" alt="book image not found"  height="300" width="300">
                </div>
                <div class="col-8">
                    <h3><b>Title :</b> {{ $book->title }} </h3>
                    <h5><b>Author :</b> <span style="font-size: 1rem">{{ $book->author }}</span> </h5>
                    <h5><b>Publication :</b> <span style="font-size: 1rem"> {{ $book->publication }} </span></h5>
                    <h5><b>Category :</b> <span style="font-size: 1rem"> {{ $book->category }}</span> </h5>
                    <h5><b>ISBN :</b><span style="font-size: 1rem">  1212345678</span> </h5>
                    <h5><b>Totlal Books :</b><span style="font-size: 1rem">  {{ count( $book->bookDetails) }}</span> </h5>
                    <table class="table table-hover display" id="book-list">
                        <thead>
                          <tr>
                            <th>Edition</th>
                            <th>Price</th>
                            <th>Book Codes</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ( $book->editions as $key=>$item)
                            
                              <tr>
                                <td> <span class="badge">{{ $key  }} </span></td>
                                <td> <span class="badge"> {{ $item["price"]  }}</span></td>
                                <td>
                                  @foreach ($item["book_codes"] as $c )
                                     <span class="badge">{{ $c }}</span> 
                                  @endforeach
                                </td>
                                <td>
                                    @if ($item["status"]=1)
                                        <span class="small badge badge-success">Available</span>
                                    @endif
                                </td>
                              </tr>  
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>

          </div>
          <div class="card-footer bg-primary">

          </div>
        </div>
      </div>
    
</div>
 
@endsection