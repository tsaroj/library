@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Book Details</h3>
            </div>
        {{-- @if(Session::has('success'))
        <div class="alert alert-success">
          Swal.fire('Oops...', 'Something went wrong!', 'error')
            {{Session::get('success')}}
        </div>
        @endif --}}
            <!-- form start -->
            <form  method="POST" id="formValidation" action="{{ route('book.details') }}">
              @csrf
              <div class="card-body">

                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="id"  value="{{ $book->id }}" >  
                </div>
                <div class="form-group">
                  <label for="Book title">Book Title</label>
                  <input type="text" class="form-control " id="title" value="{{ $book->title }}" readonly>
                </div>
                
                <div class="form-group">
                  <label for="Book Authors">Book Authors</label>
                  <input type="text" class="form-control" id="author"  value="{{ $book->author }}" readonly>
                </div>
                <div class="form-group">
                  <label for="Book publication">Publication</label>
                  <input type="text" class="form-control" id="publication"value="{{ $book->publication }}" readonly>
                </div>
                <div class="form-group">
                  <label for="Book category">Category</label>
                  <input type="text" class="form-control " id="category"  value="{{ $book->category }}" readonly>
                </div>
                <div class="form-group">
                  <label for="Book ISBN">ISBN</label>
                  <input type="text" class="form-control " name="isbn" id="isbn"  placeholder="Enter ISBN" >
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
                      <input type="text" name="addmore[0][edition]" placeholder="Book Edition" class="form-control @error('addmore[0][edition]') is-invalid @enderror" value="{{ old('addmore[0][edition]"') }}"  required />
                      @error('addmore[0][book_code]')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>  
      
                    <td>
                      <input type="text" name="addmore[0][book_code]" placeholder="Book Code" class="form-control @error('addmore[0][book_code]"') is-invalid @enderror" value="{{ old('addmore[0][book_code]') }}" minlength="6" maxlength="6"  required/>
                      @error('addmore[0][book_code]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>  
      
                    <td>
                      <input type="text" name="addmore[0][price]" placeholder="Book Price" class="form-control @error('addmore[0][price]') is-invalid @enderror" value="{{ old('addmore[0][price]"') }}" required />
                      @error('addmore[0][price]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </td>  
      
                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
      
                  </tr>  
      
                </table>
                <hr>
                <div class="form-group">
                  <button type="button" class="btn btn-danger">Cancel</button>
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                </div>
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
      $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][edition]" placeholder="Enter edition" class="form-control" required " /></td><td><input type="text" name="addmore['+i+'][book_code]" placeholder="Enter Book Code" class="form-control " minlength="6" maxlength="6"  required" /> </td><td><input type="text" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control" required" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
      
  });
  $(document).on('click', '.remove-tr', function(){  
       $(this).parents('tr').remove();
  });
</script>
<script>
  $("#formValidation").validate({
    rules:{
      addmore:{
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