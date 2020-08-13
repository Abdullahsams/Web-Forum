@extends('adminlte.master') 

@section('content')
        <div class="ml-3 mt-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Pertanyaan : {{ $list->id}} </h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
              <form role="form" action='/posts/{{$list->id}}' method='POST' >
                  @csrf
                  @method('PUT')

                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value ="{{old('title',$list->title)}}" placeholder="masukkan judul pertanyaan">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="body">Pertanyaan</label>
                    <input type="text" class="form-control" id="body" name="body" value ="{{old('body',$list->body)}}" placeholder="masukkan pertanyaan">
                    @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                  </div>               
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
            
@endsection