@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <div class="card-title">
              Student Details
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('img/default_book.png') }}" alt="book image not found"  height="300" width="300">
                </div>
    
                <div class="col-8">
                    <h3><b>Name :</b> {{ $dataStudent['name'] }} </h3>
                    <h5><b>Address :</b> <span style="font-size: 1rem">{{ $dataStudent['address'] }}</span> </h5>
                    <h5><b>Gender :</b> <span style="font-size: 1rem"> {{ $dataStudent['gender']==1?'Male':'Female' }} </span></h5>
                    <h5><b>Date of Birth :</b> <span style="font-size: 1rem"> {{ $dataStudent['date_of_birth'] }}</span> </h5>
                    <h5><b>Status :</b> 
                        @if ($dataStudent['status']=1)
                            <span class="badge badge-success">Available</span>
                        @else
                        <span class="badge badge-danger">Blocked</span>

                        @endif
                    </h5>
                    
                    
                </div>
              </div>

          </div>
          <div class="card-footer bg-primary">

          </div>
        </div>
      </div>
    
</div>
<div class="row ">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">  Students </h3>
            </div>
            <!-- /.card-header -->
        </div>
            <!-- form start -->
            <div class="card">
                

                <div class="card-body table-responsive p-2 mt-2">
                  <table class="table table-hover display" id="book-list">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publication</th>
                        <th>Book Access Code</th>
                        <th>Issued Date (dd-mm-yyyy)</th>
                        <th>Issued By</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($books as $bookD)
                     
                      <tr>
                        <a class="table-row" href="route{{ 'book.create' }}"> 
                        <td>{{ $bookD["id"] }}</td>
                        <td>{{ $bookD->book_detail->book->title }}</td>
                        <td>{{ $bookD->book_detail->book->author }}</td>
                        <td>{{ $bookD->book_detail->book->publication }}</td>
                        <td>{{ $bookD->book_detail->book_code }}</td>
                        <td>{{ $bookD->created_at->format('d-m-Y') }}<br>{{ $bookD->created_at->diffForHumans() }}</td>
                        <td>{{ $bookD->user->name }}</td>
                        
                      </tr>  
                      
                      @endforeach
                    </tbody>
                  </table>
                 
                </div>
                <div class="card-footer  bg-primary ">
                  
                </div>
              </div>
              
        </div>
    </div>
    
</div>
 
@endsection