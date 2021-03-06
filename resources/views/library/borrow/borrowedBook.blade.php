@extends('layouts.library_app')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<style>
  tr>td{
    vertical-align: middle!important;
  }
</style>

@endsection
@section('content')
<div class="row">
  @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">  Issued Books </h3>
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
                        <th>Access code</th>
                        <th>Student</th>
                        <th>Issued By</th>
                        <th>issued Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($issuedBook as $book)
                     
                      <tr>
                        <a class="table-row" href="route{{ 'book.create' }}"> 
                        <td>{{ $book["id"] }}</td>
                        <td>{{ $book->book_detail->book->title }}</td>
                        <td>{{ $book->book_detail->book->author }}</td>
                        <td>{{ $book->book_detail->book->publication }}</td>
                        <td>{{ $book->book_detail->book_code }}</td>
                        <td>{{ $book->user->name }}</td>
                        <td>{{ $book->user->name }}</td>
                        <td>{{ $book->created_at->format('d-m-Y') }}</td>
                                             
                        
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

@push('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script>
  $(document).ready( function () {
    $('#book-list').DataTable();
  } );
</script>


@endpush