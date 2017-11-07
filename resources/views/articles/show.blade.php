@extends('layouts.app')

@push('meta')
	<meta name="description" content="{!! $article->short_description !!}">
	<meta name="keywords" content="{!! implode(' ', $article->tags->pluck('name')->toArray()) !!}">
@endpush

@section('content')
<article class="post single-post text-post">
 	@if($article->image)
		<a href="{!! route('articles.show', ['id' => $article->id, 'slug' => $article->alias]) !!}" class="entry-media">
			<img src="{!! \Storage::url($article->image) !!}" alt="" />
		</a>
	@endif
	<div style="margin-bottom: 20px; margin-top: 10px">
		<div class="entry-body pull-left">
			<h2 class="entry-title">
				{!! $article->title !!}
			</h2>
		</div>

		<div class="entry-meta pull-right">
			<span class="entry-type"></span>
			<span class="entry-date">{!! $article->created_at->diffForHumans() !!}</span>
		</div>

		<div class="clearfix"></div>
	</div>

	<div class="entry-content">
		{!! $article->description !!}
		<hr class="article-footer">
		<p class="article-category">Категория: <a href="{!! route('categories.show', ['id' => $article->category->id]) !!}"><i>{{ $article->category->name }}</i></a></p>
		@if($article->tags()->count() > 0)
			<p class="article-tags">
				Теги: 
				@foreach($article->tags as $tag)
					<a href="{!! route('tags.show', ['id' => $tag->id]) !!}"><i>{{ $tag->name }}</i></a>
					@if(!$loop->last)
						, 
					@endif
				@endforeach
			</p>
		@endif
	</div>

	<div class="clr"></div>

	@include('articles.partials.comments')
</article>
@endsection

@push('styles')
	<link href="/css/prism.css" rel="stylesheet">
@endpush

@push('scripts')
	<script type="text/javascript" src="/js/clipboard.min.js"></script>
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
	                if (response.ok === true) {
	                    $(document).find('#comments').replaceWith(response.view);
					}
					else {
	                    alert('error');
					}
	            })
	            .fail(function(response) {
	            	 $(this).find('.help-block').html('');
	                 $.each(response.responseJSON, function(field, value) {
                         $(this).find('[name="' + field + '"] + .help-block').html(value);
	                 }.bind(this));
	            });
			});

            $(document).on('click', '#comments .delete', function(event) {
                event.preventDefault();

                if (confirm('Удалить комментарий') === true) {
                    $.ajax({
                        url: $(this).attr('rel'),
                        type: 'POST',
                        data: {'_method' : 'DELETE'},
                        dataType: 'json',
                        context: this
                    })
                    .done(function(response) {
                        if (response.ok === true) {
                            $(this).closest('.comment').parent('li').remove();
                        }
                        else {
                            alert('Can`t delete file');
                        }
                    })
                    .fail(function(response) {
                        alert('Unknown error');
                    });
                }
            });
		});
	</script>
@endpush