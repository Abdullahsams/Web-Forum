@extends('adminlte.master') 

@push('script-head')
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

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
                <table class="table table-bordered question-datatable">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Title</th>
                      <th>Body</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>

                  <tbody>                    
                    @forelse($list as $key => $data)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$data->title}} </td>
                            <td> {!! $data->body !!} </td>
                            <td style='display:flex'>
                                <a href="/posts/{{$data->id}}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="/posts/{{$data->id}}/edit" class="btn btn-success btn-xs">Edit</a>
                                <form role="form" action='/posts/{{$data->id}}' method='POST' >
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="hapus" class="btn btn-danger btn-xs">
                                </form>
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

@push('scripts')
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
      $('.question-datatable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    </script>
@endpush


