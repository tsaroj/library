@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Book Details</h3>
            </div>
            <!-- /.card-header -->
              <!-- Success message -->
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('book.details') }}">
              @csrf
              <div class="card-body">

                <div class="form-group">
                    <input type="hidden" class="form-control {{ $errors->has('title') ? 'error' : '' }}" id="id"  value="{{ $book->id }}" >
                     
                </div>
                <div class="form-group">
                  <label for="Book title">Book Title</label>
                  <input type="text" class="form-control {{ $errors->has('title') ? 'error' : '' }}" id="title" value="{{ $book->title }}" readonly>
                      <!-- Error -->
                    @if ($errors->has('title'))
                    <div class="alert  alert-danger my-1">
                        {{ $errors->first('title') }}
                    </div>
                    @endif
                    <!-- / Error -->
                </div>
                
                <div class="form-group">
                    <label for="Book Authors">Book Authors</label>
                    <input type="text" class="form-control {{ $errors->has('author') ? 'error' : '' }}" id="author"  value="{{ $book->author }}" readonly>
                      <!-- Error -->
                      @if ($errors->has('author'))
                      <div class="alert  alert-danger my-1 ">
                          {{ $errors->first('author') }}
                      </div>
                      @endif
                      <!-- / Error -->
                  </div>
                  <div class="form-group">
                    <label for="Book publication">Publication</label>
                    <input type="text" class="form-control {{ $errors->has('publication') ? 'error' : '' }}" id="publication"value="{{ $book->publication }}" readonly>
                      <!-- Error -->
                      @if ($errors->has('publication'))
                      <div class="alert  alert-danger my-1">
                          {{ $errors->first('publication') }}
                      </div>
                      @endif
                      <!-- / Error -->
                  </div>
                  <div class="form-group">
                    <label for="Book category">Category</label>
                    <input type="text" class="form-control {{ $errors->has('category') ? 'error' : '' }}" id="category"  value="{{ $book->category }}" readonly>
                    <!-- Error -->
                    @if ($errors->has('category'))
                    <div class="alert  alert-danger my-1">
                        {{ $errors->first('category') }}
                    </div>
                    @endif
                    <!-- / Error -->
                  </div>
                  <div class="form-group">
                    <label for="Book ISBN">ISBN</label>
                    <input type="text" class="form-control {{ $errors->has('isbn') ? 'error' : '' }}" id="isbn"  placeholder="Enter ISBN">
                      <!-- Error -->
                      @if ($errors->has('isbn'))
                      <div class="alert  alert-danger my-1">
                          {{ $errors->first('isbn') }}
                      </div>
                      @endif
                      <!-- / Error -->
                  </div>
                  <table class="table " id="dynamicTable">  
                    <tr>
                        <th>Edition</th>
                        <th>Book Code</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <tr>  
                        <td>
                          <input type="text" name="addmore[0][edition]" placeholder="Book Edition" class="form-control {{ $errors->has('name') ? 'error' : '' }}" />
                            <!-- Error -->
                            @if ($errors->has('edition'))
                            <div class="alert  alert-danger my-1">
                                {{ $errors->first('edition') }}
                            </div>
                            @endif
                            <!-- / Error -->
                        </td>  
        
                        <td>
                          <input type="text" name="addmore[0][book_code]" placeholder="Book Code" class="form-control {{ $errors->has('name') ? 'error' : '' }}" />
                            <!-- Error -->
                            @if ($errors->has('book_code'))
                            <div class="alert  alert-danger my-1">
                                {{ $errors->first('book_code') }}
                            </div>
                            @endif
                            <!-- / Error -->
                        </td>  
        
                        <td>
                          <input type="text" name="addmore[0][price]" placeholder="Book Price" class="form-control {{ $errors->has('name') ? 'error' : '' }}" />
                            <!-- Error -->
                            @if ($errors->has('price'))
                            <div class="alert  alert-danger my-1">
                                {{ $errors->first('price') }}
                            </div>
                            @endif
                            <!-- / Error -->
                        </td>  
        
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
        
                    </tr>  
        
                </table>

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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
@endpush