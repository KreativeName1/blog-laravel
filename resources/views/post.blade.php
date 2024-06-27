@extends('layouts/blog')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
  <div class="container">
    <div class="text-center my-5">
      <h1 class="fw-bolder">{{$post->title}}</h1>
    </div>
  </div>
</header>
<!-- Page content-->
<div class="container mb-4">
  <div class="row">
    <div class="col-lg-12">
      <div class="small text-muted">Created at: {{ $post->created_at }}</div>
      <div class="small text-muted mb-2">Updated at: {{ $post->updated_at }}</div>
      @if(auth()->check())
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <div class="small text-muted">
        <button class="heart-count" data-post="{{ $post->id }}">❤️ {{ count($post->hearts) }}</button>
      </div>
      <script>
        $(document).ready(function() {
          $('.heart-count').click(function() {
            const postId = $(this).data('post');
            $.ajax({
              url: '/heart/' + postId,
              method: 'POST',
              data: {
                _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                console.log(response);
                $('.heart-count').html('❤️ ' + response.hearts);
              }
            });
          });
        });
      </script>

      @else
      <div class="small text-muted">
        <!-- show -->
         <button class="heart-count">❤️ {{ count($post->hearts) }}</button>
        <a href="{{ route('login') }}">Login</a> to heart this post
      </div>
      @endif
    </div>


    <div class="col-lg-12 mt-3">
      <p id="markdown" class="markdown-body lead mb-0">{{ $post->text }}</p>
    </div>
  </div>
</div>
<script>
  // Configure marked.js to use highlight.js for code blocks
  marked.setOptions({
    highlight: function(code, lang) {
      const language = hljs.getLanguage(lang) ? lang : 'plaintext';
      return hljs.highlight(code, {
        language
      }).value;
    }
  });

  // Render the markdown text
  document.getElementById('markdown').innerHTML = marked.parse(document.getElementById('markdown').innerHTML);
  document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
  });
</script>
@endsection