@extends('adminlte.master') 

@section('content')
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
                    <div class = 'row  d-flex justify-content-center' >                               
                        <h4 class = 'font-weight-bold'> {{$list->like}} </h4>
                    </div>

                    <div class = 'row d-flex justify-content-center'>
                        @auth                               
                            <a href="/posts/{{$list->id}}" class="btn btn-danger btn-md"> Vote</a>
                        @endauth

                        @guest
                            <h4 color = 'text-danger'>Vote</h4>
                        @endguest
                    </div>

                    <div class = 'row'> <p></p> </div>
                </div>

                <div class='col col-sm-11'>
                    <div class='row'>
                        <p> {{ $list->body }}  </p>
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
                                <p> {{$comment->body}} ,
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

            <div class = 'row mt-2'>
                <div class = 'col col-sm-10'>
                    <h5 class="font-weight-bold">Jawaban
                    </h5>
                </div>
                <div class = 'col col-sm-2'>
                    <a class='btn btn-primary mb-2' href='/posts/create' >Kirim Jawaban
                    </a>
                </div>
            </div>

            @forelse($list->answer as $answ) 
            <div class='row'>
                <div class='col col-sm-1'>
                    <div class = 'row  d-flex justify-content-center' >                               
                        <h4 class = 'font-weight-bold'> {{$answ->like}} </h4>
                    </div>

                    <div class = 'row d-flex justify-content-center'>
                        @auth                               
                            <a href="/posts/{{$list->id}}" class="btn btn-danger btn-md"> Vote</a>
                        @endauth

                        @guest
                            <h4 color = 'text-danger'>Vote</h4>
                        @endguest
                    </div>               
                </div>

                <div class='col col-sm-11'>

                    <div class='row '>
                        <p> {{$answ->isi}} </p>                        
                    </div>
                    <div class='row'>
                        <p> oleh : {{$answ->author->name}} , {{$answ->created_at}} 
                        </p>
                    </div>
                </div>
            </div>


            @empty
                <p> belum ada jawaban </p>
            @endforelse

        </div>
    </div>

</div>
@endsection
