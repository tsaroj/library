@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Book</h3>
            </div>
            <!-- /.card-header -->
              <!-- Success message -->
        {{-- @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif --}}
            <!-- form start -->
            <form role="form" id="bookData" method="POST" action="{{ Route('book.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="Book title">Book Title</label>
                  <input type="text" name="title" id="title" placeholder="Enter Book Name" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"  required  >
                    @error('title')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Book Authors">Book Authors</label>
                    <input type="text"  id="author" name="author"  class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}"   placeholder="Enter Book Authors" required>
                      @error('author')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="Book publication">Publication</label>
                    <input type="text" id="publication" name="publication" class="form-control @error('publication') is-invalid @enderror" value="{{ old('publication') }}"  placeholder="Enter Publication" required>
                      @error('publication')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="Book category">Category</label>
                    <input type="text" id="category" name="category" class="form-control  @error('category') is-invalid @enderror" value="{{ old('category') }}"  placeholder="Enter Category" required>
                      @error('category')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="Book ISBN">ISBN</label>
                    <input type="text" id="isbn" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}"  placeholder="Enter ISBN" required>
                      @error('addmore[0][book_code]')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  <hr>
                  <div class="form-group">
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                  </div>
            </form>
        </div>
    </div>
    
</div>
 
@endsection

@push('script')
<script type="text/javascript">
   var i = 0;
  $("#add").click(function(){
      ++i;
      $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][edition]" placeholder="Enter edition" class="form-control {{ $errors->has('edition') ? 'error' : '' }}" /></td><td><input type="text" name="addmore['+i+'][book_code]" placeholder="Enter Book Code" class="form-control {{ $errors->has('book_code') ? 'error' : '' }}" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control {{ $errors->has('price') ? 'error' : '' }}" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
      
  });
  $(document).on('click', '.remove-tr', function(){  
       $(this).parents('tr').remove();
  });
</script>


<script>
  $("#bookData").validate({
    rules:{
      title:{
        required:true,
      },
      author:{
        required:true,
      },
      publication:{
        required:true,
      },
      category:{
        required:true,
      },
      isbn:{
        required:true,
      }

    }
  });
</script>
@endpush

@push('styles')
<style>
   .error{
      color:red;
  } 
</style>
    
@endpush