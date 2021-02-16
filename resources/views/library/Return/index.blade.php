@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Borrow New Book</h3>
            </div>
            <div id="container">
              <div id="contents">
              <form role="form" id="borrowDetail" method="POST" action="#">
                  @method('DELETE')
              @csrf
              {{-- <input type="hidden" name="student_id" id="h_student_id" value="" required> --}}
              <input type="hidden" name="bookdetail_id" id="h_bookdetail_id" value="{{$borrowed == null?old('bookdetail_id'):$borrowed['bookdetail_id']}}" required>
              <div class="card-body">
                <div class="form-group">
                    <label for="Book Id">Book Code</label>
                    <input  type="text"  id="book_code"  class="form-control @error('book_code') is-invalid @enderror" value="{{ old('book_code') }}"   placeholder="Enter Book Code" required>
                      @error('book_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>

                <div class="row d-none" id="bookResultContainer">
                    <div class="col-12">
                      <table id="bookTable" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>bookdetail_id</td>
                            <td>student_id</td>
                            <td>issued_by</td>
                            <td>borrow_date</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr></tr>
                        </tbody>
                      </table>               
                    </div>
                  </div>

            </form>
          </div>
        </div>
        </div>
        <div class="card-footer">
          <div class="form-group">
            <button type="button" class="btn btn-danger" id="btnReload">New</button>
            <button type="submit" class="btn btn-success float-right">Submit</button>
          </div>
        </div>
    </div>
    
</div>
@endsection


@push('script')
   <script>
        $(document).ready(function () {
            $(document).on('keyup', '#book_code', function () {
                if ($(this).val()!='') {
                    var url = '{{ Route('retun.get.books',['return'=>'__bookcode__']) }}';
                    var searchURL = url.replace('__bookcode__',$(this).val());
                    var bookcode = $(this).val();
                    var dataString = $("#book_code").val();

                    $.ajax({
                        type: 'GET',
                        url:searchURL,
                        dataType: 'json',
                        success: function(result){
                            $('#bookResultContainer').addClass('d-none');
                            $('#h_bookdetail_id').val('');
                            $('#bookTable').children('tbody').children('tr').empty();
                            console.log(result);
                            if(result.status)
                            {
                                var dataX = result.data;
                                var dataY = result.status;
                                var bookdetail_id = dataX['id'];
                                console.log(result.data);

                                    if(dataX != '' && dataX !=0 ){
                                    
                                      $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['bookdetail_id']+'</td>');
                                      $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['student_id']+'</td>');
                                      $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['issued_by']+'</td>');
                                      $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['borrow_date']+'</td>'); 
                                      $('#bookTable').children('tbody').children('tr').append('<td class="text-right"><button type="button" data-book-id="'+bookdetail_id+'" class="w-100 btn-return-book btn btn-danger"><i class="fa fa-plus-circle"></i>Return</button></td>'); 
                                      $('#bookResultContainer').removeClass('d-none');
                                    
                                    }else 
                                        $('#bookTable').append('<div class="alert alert-danger">Book not Found</div>');
                                    
                                   
                            }
                        }
                    });
                }
            });
        });




        $(document).on('click','.btn-return-book',function(){
            var suff = $(this).data('book-id');
            $('#h_bookdetail_id').val($(this).data('book-id'));

            var url = '{{route('return.destroy',['return'=>'__bookdetailid__'])}}';


            var returnURL = url.replace("__bookdetailid__",suff);
            // alert(returnURL);



          


            var form = $('#borrowDetail');

            $.ajax({
            type: 'POST',
            url:returnURL,
            data: form.serialize(),
            dataType: 'json',
            success: function(result){
                console.log(result.status);
                // if(result.status)
                // {
                // if($('#h_student_id').val() != '' && $('#h_bookdetail_id').val() != '')
                // {
                //     var reload = '{{route('borrow.reload.students',['student'=>'__student__'])}}';
                //     var reload = reload.replace('__student__',$('#h_student_id').val());
                //     $('#container').load(reload+' #contents');
                // }
                // $(this).html('Added');
                // $(this).prop('disabled',true);
                // }
                // else{
                // swal(result.msg,'', "error");
                // }
            }
            });
        });

   </script>
@endpush