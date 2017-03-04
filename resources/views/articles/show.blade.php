@extends('layouts.app')

@section('content')
<!-- Example of image blog item
================================================== -->
{{-- <article class="post single-post text-post"> --}}
<article class="post single-post text-post">

	<!-- entry media -->
 	@if($article->image)
		<a href="/{!! $article->id !!}/{!! $article->alias !!}" class="entry-media">
			<img src="/storage/{!! $article->image !!}" alt="" />
		</a>
	@endif

	<div style="margin-bottom: 20px; margin-top: 10px">
		<!-- entry body -->
		<div class="entry-body pull-left">
			<h2 class="entry-title">
				{!! $article->title !!}
			</h2>
		</div>

		<!-- entry meta -->
		<div class="entry-meta pull-right">
			<span class="entry-type"></span>
			<span class="entry-date">{!! $article->created_at->diffForHumans() !!}</span>
		</div>

		<div class="clearfix"></div>
	</div>

	<div class="entry-content">
		{!! $article->description !!}
		<hr>
		<p>Категория: <a href="{{ url('/categories/'.$article->category->id) }}"><i>{{ $article->category->name }}</i></a></p>

		<p>
			Теги: 
			@foreach($article->tags as $tag)
				<a href="{{ url('/tags/'.$tag->id) }}"><i>{{ $tag->name }}</i></a>
				@if(!$loop->last)
					, 
				@endif
			@endforeach
		</p>
	</div>

	<!-- clearfix -->
	<div class="clr"></div>

	<!-- Comments
	================================================== -->
	<section id="comments">
		<div id="disqus_thread"></div>
		<script>
			 var disqus_config = function () {
				 this.page.identifier = '{!! $article->id !!}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			 };
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = '//molchan.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
		</script>
	</section>

</article><!-- end item -->
@endsection

@section('styles')
	<link href="/css/prism.css" rel="stylesheet">
@endsection

@section('scripts')
	<script type="text/javascript" src="/js/prism.js"></script>
	<script>
		$(function(){
            $(document).on('click', '#comments .reply', function(event) {
                event.preventDefault();
                $(document).find('#comments-form input[name="comment_id"]').val($(this).data('id'));
                $('html, body').animate({scrollTop: $('#comments-form').offset().top}, 2000);
            });

			$(document).on('submit', '#comments-form', function(event) {
				event.preventDefault();

	            $.ajax({
	                url: $(this).attr('action'),
	                type: 'POST',
	                dataType: 'json',
	                data: new FormData(this),
	                context: this,
	                async: false,
	                cache: false,
	                contentType: false,
	                processData: false
	            })
	            .done(function(response) {
	                if (response.ok == true) {
	                    $(document).find('#comments').replaceWith(response.view);
					}
					else {
	                    alert('error');
					}
	            })
	            .fail(function(response) {
	            	console.log(response);
	            	// this.submitButton.prop('disabled', false).html(this.submitButtonValue);
	            	 $(this).find('.help-block').html('');
	                 $.each(response.responseJSON, function(field, value) {
                         $(this).find('[name="' + field + '"] + .help-block').html(value);
	                 }.bind(this));
	            });
				
			});
		});
	</script>
@endsection