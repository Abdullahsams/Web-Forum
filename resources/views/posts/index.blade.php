@extends('adminlte.master') 

@section('content')

    @if(session('sukses'))
              <div class='alert alert-danger'> 
                  {{session('sukses')}}
              </div>
    @endif

  <div class = 'mt-3 ml-3'>
    <div class="card">
        <div class="card-header">
            <div class = 'row'>
                <div class = 'col col-sm-10'>
                  <h2 class="card-title">Pertanyaan</h2>
                </div>
                <div class = 'col col-sm-2'>
                        <a class='btn btn-primary mb-2' href='/posts/create' >Ajukan Pertanyaan</a>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
                
          @if(session('sukses'))
              <div class='alert alert-success'> 
                  {{session('sukses')}}
              </div>
          @endif
              

          <tbody>                    
              @forelse($list as $key => $data)
                  <div class ='content'>                      
                      <div class = 'row'>
                          <div class='col col-sm-1'>
                              <div class = 'row  d-flex justify-content-center' >                               
                                  <h5> {{$data->vote}} </h5>
                              </div>

                              <div class = 'row d-flex justify-content-center'>                               
                                    <h5 color = 'text-danger'>Vote</h5>
                              </div>
                              <div class = 'row'> <p></p> </div>
                            
                          </div>
                        

                          <div class='col col-sm-11'>
                              <div class = 'row'>                               
                                  <a href="/posts/{{$data->id}}" class="card-title text-primary font-weight-bold">{{$data->title}}</a>
                              </div>
                            
                              <div>
                                  <h5 class="card-text">{!!$data->body!!} </h5>
                              </div>
                            
                              <div>
                                  <p class="card-text" > oleh : {{$data->author->name}} , {{$data->created_at}} </p>                                                         
                              </div>
                          </div>
                        </div>
                  </div>  

                <hr />
            @empty
                <tr>
                    <td colspan="4" align = "center">Tidak ada pertanyaan</td>
                </tr>                           
            @endforelse                                   
        </tbody>
      </div>
      <!-- /.card-body -->              

    </div>        
    <!-- /.card -->               
  </div>
@endsection