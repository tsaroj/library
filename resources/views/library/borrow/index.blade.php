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
              <form role="form" id="bookData" method="POST" action="{{ Route('borrow.store') }}">
              @csrf
              <input type="hidden" name="student_id" id="h_student_id" value="{{$studentD == null?old('student_id'):$studentD['id']}}" required>
              <input type="hidden" name="book_id" id="h_book_id" required>
              <div class="card-body">
                <div class="form-group">
                  <label for="student id">Student ID</label>
                  <input autocomplete="off" type="text"  id="student_id" placeholder="Enter Student ID" class="form-control @error('student_id') is-invalid @enderror" value="{{$studentD == null?old('student_id'):$studentD['name']}}" {{$studentD == null?'':'readonly'}}  required  >
                    @error('student_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <div id="studentTable1">
                      

                    </div>
                </div>
                <div class="row d-none" id="studentResultContainer">
                  <div class="col-12">
                   
                    <table id="studentTable" class="table table-bordered">
                      <thead>
                        <tr>
                          <td>ID</td>
                          <td>NAME</td>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr></tr>
                      </tbody>
                    </table>
                   
                  </div>
                </div>
                @if(count($dataBook) > 0)
                <div class="row">
                  <div class="col-12" >
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <td>SN</td>
                          <td>Book</td>
                          <td>Access Code</td>
                          <td>Issue Date</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dataBook as $key=>$dBook)
                        <tr class="bg-naya">
                          <td>{{ $key+1 }}</td>
                          <td>{{ $dBook['book_detail']['book']['title'] }}</td>
                          <td>{{ $dBook['book_detail']['book_code'] }}</td>
                          <td>{{ $dBook['borrow_date'] }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="Book Id">Book ID</label>
                    <input {{ ($isMaxBook == 1)?'disabled':'' }} type="text"  id="book_id"  class="form-control @error('book_id') is-invalid @enderror" value="{{ old('book_id') }}"   placeholder="Enter Book Code" required>
                      @error('book_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                  @if(!$isMaxBook)
                  <div class="row d-none" id="bookResultContainer">
                    <div class="col-12">
                      <table id="bookTable" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Title</td>
                            <td>Author</td>
                            <td>Pub</td>
                            <td>Cate</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr></tr>
                        </tbody>
                      </table>               
                    </div>
                  </div>
                  @else
                        <div class="w-100 alert alert-danger"><i class="fa fa-exclamation-triangle"></i>&nbsp;Maxmium Book Allocated</div>
                      @endif   
                  <hr>
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
     $(document).ready(function(){
         var puranoSearch;
         $(document).on('keyup','#book_id',function(){
            if($(this).val() != '')
{             var bookURL = '{{route('borrow.get.books',['borrow'=>'__bookid__'])}}';
              var bookURL = bookURL.replace("__bookid__",$(this).val());
              var bookID = $(this).val();
              $.ajax({
                type: 'GET',
                url:bookURL,
                dataType: 'json',
                success: function(result){
                  $('#bookResultContainer').addClass('d-none');
                  $('#h_book_id').val('');
                  $('#bookTable').children('tbody').children('tr').empty();
                  console.log(result);
                  if(result.status)
                  {
                    var dataX = result.data;
                    var bookid = dataX['id'];
                    
                    if(dataX != ''){
                      
                      if(result.issued)
                      {
                        $('#bookTable').children('tbody').children('tr').append('<td colspan="5" class="text-center font-weight-bold"> Selected Book Already Issued to Other Student!! </td>');
                        $('#bookResultContainer').removeClass('d-none');
                      }
                      else
                      {
                        $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['book']['title']+'</td>');
                        $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['book']['author']+'</td>');
                        $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['book']['publication']+'</td>');
                        $('#bookTable').children('tbody').children('tr').append('<td>'+dataX['book']['category']+'</td>'); 
                        $('#bookTable').children('tbody').children('tr').append('<td class="text-right"><button type="button" data-book-id="'+bookid+'" class="w-100 btn-add-book btn btn-primary" '+((result.issued)?'disabled':'')+'><i class="fa fa-plus-circle"></i>Issue</button></td>'); 
                        $('#bookResultContainer').removeClass('d-none');
                      }
                    }
                  }
              }});
             }
                });

        @if($studentD == NULL)
          $(document).on('keyup','#student_id',function(){
            
            $('#studentResultContainer').addClass('d-none');
                $('#h_student_id').val('');
                $('#studentTable').children('tbody').children('tr').empty();
                $('#studentTable1').empty();
            if($(this).val() != '')
        {  var studentURL = '{{route('borrow.get.students',['student_id'=>'__studentid__'])}}';
              var studentURL = studentURL.replace("__studentid__",$(this).val());
              var studentID = $(this).val();
              $.ajax({
                type: 'GET',
                url:studentURL,
                dataType: 'json',
                success: function(result){
                  $('#studentResultContainer').addClass('d-none');
                  $('#h_student_id').val('');
                  $('#studentTable').children('tbody').children('tr').empty();
                  $('#studentTable1').empty();
                  if(result.status)
                  {
                    var dataX = result.data;
                    var studentid = dataX['id'];
                    if(dataX != '' && dataX !=0){
                      $('#studentTable').children('tbody').children('tr').append('<td>'+dataX['id']+'</td>');
                      $('#studentTable').children('tbody').children('tr').append('<td>'+dataX['name']+'</td>');
                      $('#studentTable').children('tbody').children('tr').append('<td class="text-right"><button type="button" data-student-name="'+dataX['name']+'" data-student-id="'+studentid+'" class="w-100 btn-add-student btn btn-primary"><i class="fa fa-plus-circle"></i>Select</button></td>'); 
                      $('#studentResultContainer').removeClass('d-none');
                    }
                    else if(dataX == 0){
                      $('#studentTable1').append('<div class="alert alert-danger">Student not Found</div>');
                    }
                  }
                  else{
                    $('#studentResultContainer').addClass('d-none');
                $('#h_student_id').val('');
                $('#studentTable').children('tbody').children('tr').empty();
                $('#studentTable1').empty();
                  }
              }});
             }
                });

          $(document).on('click','.btn-add-student',function(){
            var std_id = $(this).data('student-id');
            if(std_id != '')
            {
              var reload = '{{route('borrow.reload.students',['student'=>'__student__'])}}';
              var reload = reload.replace('__student__',std_id);
              $('#container').load(reload+' #contents');
            }
          });
@endif

  $(document).on('click','.btn-add-book',function(){
    $('#h_book_id').val($(this).data('book-id'));
    var studentURL = '{{route('borrow.store')}}';
    var form = $('#bookData');
    $.ajax({
      type: 'POST',
      url:studentURL,
      data: form.serialize(),
      dataType: 'json',
      success: function(result){
        if(result.status)
        {
          if($('#h_student_id').val() != '' && $('#h_book_id').val() != '')
          {
            var reload = '{{route('borrow.reload.students',['student'=>'__student__'])}}';
            var reload = reload.replace('__student__',$('#h_student_id').val());
            $('#container').load(reload+' #contents');
          }
          $(this).html('Added');
          $(this).prop('disabled',true);
          swal(result.msg,'', "success")
        }
        else{
          swal(result.msg,'', "error");
        }
      }
    });
  });

  $(document).on('click','#btnReload',function(){
      $('#container').load(' #contents');
  });


});
  </script>
    
@endpush