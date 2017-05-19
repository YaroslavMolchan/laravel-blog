@extends('layouts.main')

@section('main')
    <!-- #blog -->
    <div class="row" id="blog">

        <!-- posts -->
        <div class="span8">

            @yield('content')

        </div><!-- end .span8 -->

        <!-- Sidebar with widgets
        ================================================== -->
        <div class="sidebar span4">
            @inject('sidebar', 'App\Services\SidebarDataService')
            <!-- search plugin -->
            <div class="widget">
                <form class="form-search" action="{!! route('articles.search') !!}">
                    <div class="input-append">
                        <input id="main_search" type="search" name="query" class="span2 search-query animated" value="{!! request()->query('query') !!}">
                        <button type="submit" class="btn">Search</button>
                        {{--<div class="autocomplete-suggestions"></div>--}}
                    </div>
                </form>
                {{--<form>--}}
                {{--<input id="main_search" type="search" class="animated" placeholder="Search" />--}}
                {{--<button type="submit">s</button>--}}
                {{--</form>--}}
            </div>


            <!-- Categories -->
            <div class="widget">
                <h4>Категории</h4>
                <ul class="icons-ul list-style">
                    @forelse($sidebar->categories() as $category)
                        <li><a href="{!! route('categories.show', ['id' => $category->id]) !!}"><i
                                        class="icon-li icon-chevron-right"></i>{!! $category->name !!}</a></li>
                    @empty
                        <li>Категорий пока нет</li>
                    @endforelse
                </ul>
            </div>

            <!-- Tags -->
            <div class="widget">
                <h4>Теги</h4>
                <ul class="tags">
                    @forelse($sidebar->tags() as $tag)
                        <li><a href="{!! route('tags.show', ['id' => $tag->id]) !!}">{!! $tag->name !!}</a></li>
                    @empty
                        <li>Тегов пока нет</li>
                    @endforelse
                </ul>
            </div>
        </div><!-- end sidebar -->
    </div><!-- end #blog -->
@endsection