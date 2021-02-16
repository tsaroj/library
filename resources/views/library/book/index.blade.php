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
<div class="row ">
  {{-- @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
    {!! session('message.content') !!}
    </div>
@endif --}}
  @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">  Books </h3>
              <a href="{{ Route('book.create') }}" class="btn btn-success float-right">
                <i class="fas fa-plus-circle mr-2"></i>
                  Add Book
                </a>
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
                        <th>status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($books as $book)
                     
                      <tr>
                        <a class="table-row" href="route{{ 'book.create' }}"> 
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publication }}</td>
                        <td>
                             @if ($book->status==1)
                             <span class="badge badge-success my-4 ">Available</span>
                             @else
                                 <span class="badge badge-danger my-4">Unavailable</span>
                             @endif
                        </td>
                        <td class="text-center">
                          <a href="{{ route('book.details.view',$book->id) }}">
                            <button class="btn btn-primary btn-sm mt-2"><i class="fa fa-eye"></i><span class="px-2">View</span></button>
                          </a>
                          <div class="clearfix"></div>
                          <a href="{{ route('book.details.add',$book->id) }}">
                            <button class="btn btn-success btn-sm mt-2"><i class="fa fa-plus"></i><span class="px-2">Add Detail</span></button>
                          </a>
                        </td>
                      </a>
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