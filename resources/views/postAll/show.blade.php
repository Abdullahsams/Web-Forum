@extends('adminlte.master') 

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
    <div class='mt-4 ml-4'>
        <h3> {{ $post->title }}</h3>
        <h5> {!! $post->body !!} </h5>
        <p> Author : {{$post->author->name}} , created at : {{$post->author->created_at}} </p>
    
    <div>
        Tags :
        @forelse($post->tags as $tag)
        <button class="btn btn-primary btn-sm"> {{ $tag->name }} </button>
        @empty
        No Tags
        @endforelse
    </div>
    <hr>
    {{-- <div class="col-md-12"> --}}
      <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Jawaban</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            
            <!-- Timelime example  -->
            <div class="row">
              @forelse ($all as $item)
              <div class="col-md-12">
                <div class="timeline">
                  <div class="time-label">
                    <span class="bg-red">{{ date('d F Y', strtotime($item->created_at)) }}</span>
                  </div>
                  <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> {{ date('H:i', strtotime($item->created_at)) }}</span>
                      <h3 class="timeline-header"><a href="#">{{ $item->user->name }}</a></h3>
    
                      <div class="timeline-body">
                        {!! $item->isi !!}
                      </div>
                      <hr>
                      <ul>
                        <li>Jumlah Like : {{ empty($item->like) ? 'Belum ada like' : $item->like }}</li>
                        <li>Jumlah Dislike : {{ empty($item->dislike) ? 'Belum ada dislike' : $item->dislike }}</li>
                      </ul>
                      <ul>
                        <li>Jumlah Vote : {{ empty($item->vote) ? 'Belum ada vote' : $item->vote }}</li>
                      </ul>
                      <div class="timeline-footer">
                        <div class="row">
                          <div class="col-md-2">
                            <form action="{{ url('allPosts/updateLike/'. $item->id) }}" method="post">
                              @csrf
                              @if (Auth::id() != $item->user->id)
                                <button type="submit" name="like" value="like" class="btn btn-primary btn-sm">Like</button>
                                <button type="submit" name="dislike" value="dislike" class="btn btn-danger btn-sm">Dislike</button>
                              @endif
                            </form>
                          </div>
                          <div class="col-md-2">
                            <form action="{{ url('allPosts/updateVote/'. $item->id) }}" method="post">
                              @csrf
                              @if (Auth::id() != $item->user->id)
                                <button type="submit" name="upvote" value="up" title="Up Vote" class="btn btn-primary btn-sm"><i class="fas fa-arrow-up"></i></button>
                                <button type="submit" name="downvote" value="down" title="Down Vote" class="btn btn-danger btn-sm"><i class="fas fa-arrow-down"></i></button>
                              @endif
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <i class="fas fa-clock bg-gray"></i>
                  </div>
                </div>
                {{ $all->links() }}
              </div>
              @empty
                <h1>Tidak Ada Jawaban</h1>
              @endforelse
            </div>
          </div>
        </section>
      </div>
    <hr>
    <div class="col-md-12">
        <form role="form" action='{{ route('answer.post') }}' method='POST' >
            @csrf
          <div class="form-group">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <h3><label for="description">Jawaban Antum</label></h3>
            {{-- <input type="text" class="form-control" id="body" name="body" placeholder="Description"> --}}
            <textarea name="isi" class="form-control my-editor"></textarea>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Review Your Answer</button>
          </div>
        </form>
    </div>
    
    </div>
@endsection

@push('scripts')
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endpush