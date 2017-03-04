@extends('layouts.app')

@section('content')
<!-- Example of image blog item
================================================== -->
{{-- <article class="post single-post text-post"> --}}
<article class="post single-post text-post">

	<!-- entry media -->
 	{{--<a href="blog-single.html" class="entry-media">--}}
		{{--<img src="http://farm8.staticflickr.com/7111/7048321321_9943607a32_c.jpg" alt="" />--}}
	{{--</a>--}}

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
		
		<h4>Комментарии <span>({{ $article->comments()->count() }})</span></h4>

		<ol class="commentlist">
			@forelse($article->comments as $comment)
			<li>
				<div class="comment">
					<div class="avatar"><img src="http://www.gravatar.com/avatar/?d=mm&amp;s=50" alt="" /></div>
					<div class="comment-meta">
						<strong>{{ $article->name }}</strong> 
						<span class="date">{!! $comment->created_at->diffForHumans() !!}</span>
					</div>
					<div class="comment-body">
						{{ $comment->comment }}
					</div>
				</div>
			</li>
			@empty
				<li>
					<hr>
					Комментариев пока нет.
				</li>
			@endforelse
		</ol><!-- end .commentlist -->

		{{--<h4>Оставьте комментарий</h4>--}}
		{{--<br />--}}

		{{--<!-- Comment form--}}
		{{--================================================== -->--}}
		{{--<form action="/comments" class="row" method="POST" id="comments-form">--}}
			{{--{{ csrf_field() }}--}}
			{{--<input type="hidden" name="article_id" value="{!! $article->id !!}">--}}
			{{--<div class="span3">--}}
				{{--<label>Имя</label>--}}
				{{--<input type="text" name="name" placeholder="Ваше имя" />--}}
			{{--</div>--}}
			{{--<div class="span3">--}}
				{{--<label>E-mail</label>--}}
				{{--<input type="text" name="email" placeholder="Ваш E-mail" />--}}
			{{--</div>--}}
			{{--<div class="span8">--}}
				{{--<label>Комментарий</label>--}}
				{{--<textarea name="comment" rows="6" placeholder="Ваш комментарий"></textarea>--}}
				{{--<p>--}}
					{{--<button type="submit" class="button yellow"><i class="icon-ok"></i> Отправить</button>--}}
				{{--</p>--}}
			{{--</div>--}}
		{{--</form>--}}

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
	                console.log(response);
	            })
	            .fail(function(response) {
	            	console.log(response);
	            	// this.submitButton.prop('disabled', false).html(this.submitButtonValue);
	            	// this.form.find('.help-block').html('');
	                // $.each(response.responseJSON, function(field, value) {
	                // 	this.form.find('.field-' + field + ' .help-block').html(value);
	                // }.bind(this));
	            });
				
			});
		});
	</script>
@endsection