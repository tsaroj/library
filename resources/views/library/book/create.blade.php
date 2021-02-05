@extends('layouts.library_app')

@section('content')
<div class="row ">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Book</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="Book title">Book Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Book Name">
                </div>
                <div class="form-group">
                    <label for="Book Authors">Book Authors</label>
                    <input type="text" class="form-control" id="author" placeholder="Enter Book Authors">
                  </div>
                  <div class="form-group">
                    <label for="Book publication">Publication</label>
                    <input type="text" class="form-control" id="publication" placeholder="Enter Publication">
                  </div>
                  <div class="form-group">
                    <label for="Book ISBN">Book ISBN</label>
                    <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN">
                  </div>
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