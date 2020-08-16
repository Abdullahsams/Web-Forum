@extends('adminlte.master') 

@section('content')
    @if(session('sukses'))
              <div class='alert alert-danger'> 
                  {{session('sukses')}}
              </div>
    @endif

    <div class='mt-4 ml-4'>
        <div class="container">
            <div class = 'row'>
                <div class = 'col col-sm-1'> </div>
                <div class = 'col col-sm-9'>
                    <h5 class="text-primary font-weight-bold">{{$list->title}}
                    </h5>
                </div>
                <div class = 'col col-sm-2'>
                    <a class='btn btn-primary mb-2' href='/posts/create' >Ajukan Pertanyaan
                    </a>
                </div>
            </div>

            <div class='row'>
                <div class='col col-sm-1'>
                    <div class = 'row d-flex justify-content-center'>
                        @auth                               
                            <a href="/posts/upvote/{{$list->id}}" class="text-success"> 
                            <i class="fas fa-2x fa-chevron-up"></i> 
                            </a>
                        @endauth
                    </div>

                    <div class = 'row  d-flex justify-content-center' >                               
                        <h4 class = 'font-weight-bold'> {{$list->vote}} </h4>
                    </div>

                    <div class = 'row  d-flex justify-content-center' >                               
                        <h5 class = 'font-weight-bold'> vote </h5>
                    </div>

                    <div class = 'row d-flex justify-content-center'>
                        @auth                               
                            <a href="/posts/downvote/{{$list->id}}" class="text-danger"> 
                            <i class="fas fa-2x fa-chevron-down"></i> 
                            </a>
                        @endauth
                    </div>

                    <div class = 'row'> <p></p> </div>
                </div>

                <div class='col col-sm-11'>
                    <div class='row' style="word-break:break-all;">
                        <p style="word-break:break-all;"> {!!$list->body!!}  </p>
                    </div>
               
                    <div class='row'>
                        <p> oleh : {{$list->author->name}} , {{$list->created_at}} 
                        </p>
                    </div>

                    <div class='row'>                        
                        @forelse($list->tags as $tag)                           
                            <button class='btn mr-2 btn-sm btn-success'>                                
                                {{$tag->name}}
                            </button>
                        @empty 
                            <p> no tag </p>
                        @endforelse
                    </div>

                    @auth
                        <div class='row mt-2'>
                            <form class = 'col' role="form" action='/comment/{{$list->id}}' method='POST' >
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control" id="body" name="body" placeholder="masukkan komentar anda">
                                @error('komentar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class = 'mt-2'>
                                    <button type="submit" class="btn btn-primary btn-md">Kirim</button>
                                </div>
                            </form>
                        </div>
                    @endauth
                  
                    <ul class = 'mt-2'>
                    @forelse($list->comment as $comment)                       
                        <div class='row'>
                            <li>
                                <p style="word-break:break-all;"> {{$comment->body}} ,
                                    <span style="color:blue"> {{$comment->author->name}} </span> ,
                                    {{$comment->created_at}}
                                <p>
                                
                            </li>                        
                        </div>    
                    @empty
                        <p> belum ada komentar </p>
                    @endforelse 
                    </ul>

                  </div>                    
                </div>
            </div>

            <hr />

            <div class = 'row mt-2'>
                <div class = 'col col-sm-10'>
                    <h5 class="font-weight-bold">Jawaban
                    </h5>
                </div>
                <div class = 'col col-sm-2'>
                    <a class='btn btn-primary mb-2' href='/answer/{{$list->id}}/create' >Kirim Jawaban
                    </a>
                </div>
            </div>

            @forelse($list->answer as $answ) 
            <hr />
            <div class='row mt-2'>
                <div class='col col-sm-1'>
                    <div class = 'row d-flex justify-content-center'>
                        @auth                                                      
                            <a href="/answer/upvote/{{$answ->id}}" class="text-success"> 
                            
                            <i class="fas fa-2x fa-chevron-up"></i> 
                            </a>
                        @endauth
                    </div>

                    <div class = 'row  d-flex justify-content-center' >                               
                        <h4 class = 'font-weight-bold'> {{$answ->vote}} </h4>
                    </div>

                    <div class = 'row  d-flex justify-content-center' >                               
                        <h5> vote </h5>
                    </div>

                    <div class = 'row d-flex justify-content-center'>
                        @auth                               
                            <a href="/answer/downvote/{{$answ->id}}" class="text-danger"> 
                            
                            <i class="fas fa-2x fa-chevron-down"></i> 
                            </a>
                        @endauth
                    </div>           
                </div>
                
                <div class='col col-sm-1'>
                    @auth
                    @if($answ->correct > 0)         
                        <a  href="/posts/uncorrect/{{$answ->id}}" class="text-green">
                            <i class="fas fa-2x fa-thumbs-up"></i>
                        </a>
                    @endif
                    @endauth
                    
                    @guest
                    @if($answ->correct > 0)         
                        <a  href="#" class="text-green">
                            <i class="fas fa-2x fa-thumbs-up"></i>
                        </a>
                    @endif
                    @endguest
                </div>

                <div class='col col-sm-1'>
                    @auth
                    @if($answ->correct == 0)    
                        <a href="/posts/correct/{{$answ->id}}" class="btn btn-sm btn-warning"> 
                            <i class="fas fa-2x fa-thumbs-up"></i>
                        </a>            
                    @endif                               
                    @endauth
                </div>

                <div class='col col-sm-9'>

                    <div class = 'row'>   
                        <a href="#" class="card-title text-primary font-weight-bold">{!!$answ->isi!!} </a>
                        <p>   </p>
                        
                    </div>
                    <div class='row'>                       
                        <p> oleh : {{$answ->author->name}} , {{$answ->created_at}} 
                        </p>
                    </div>

                    @auth
                        <div class='row mt-2'>
                            <form class = 'col' role="form" action='/comment/answer/{{$answ->id}}' method='POST' >
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control" id="body" name="body" placeholder="masukkan komentar anda">
                                @error('komentar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class = 'mt-2'>
                                    <button type="submit" class="btn btn-primary btn-md">Kirim</button>
                                </div>
                            </form>
                        </div>
                    @endauth

                    <ul class = 'mt-2'>
                    @forelse($answ->comment as $comment)                       
                        <div class='row' style="word-break:break-all;">
                            <li>
                                <p style="word-break:break-all;"> {{$comment->body}} ,
                                    <span style="color:blue"> {{$comment->author->name}} </span> ,
                                    {{$comment->created_at}}
                                <p>
                                
                            </li>                        
                        </div>    
                    @empty
                        <p> belum ada komentar </p>
                    @endforelse 
                    </ul>

                </div>

            </div>


            @empty
                <p> belum ada jawaban </p>
            @endforelse

        </div>
    </div>

</div>
@endsection
