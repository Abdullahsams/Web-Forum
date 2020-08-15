@extends('adminlte.master') 

@section('content')

        <div class = 'mt-3 ml-3'>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Pertanyaan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                @if(session('sukses'))
                    <div class='alert alert-success'> 
                        {{session('sukses')}}
                    </div>
                @endif

                <a class='btn btn-primary mb-2' href='/posts/create' >Create Question</a>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Body</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>

                  <tbody>                    
                    @forelse($post as $key => $data)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$data->title}} </td>
                            <td> {{$data->author->name}} </td>
                            <td> {!! $data->body !!} </td>
                            <td style='display:flex'>
                                <a href="{{ url('/allPosts/show/'.$data->id) }}" class="btn btn-info btn-xs">Lihat</a>
                            </td>
                        </tr>       
                    @empty
                        <tr>
                            <td colspan="4" align = "center">Tidak ada pertanyaan</td>
                        </tr>                 
                    @endforelse                                     
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->              
            </div>
            <!-- /.card -->               
        </div>
@endsection


