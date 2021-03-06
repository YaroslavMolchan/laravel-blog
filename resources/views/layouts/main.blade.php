<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en"> <!--<![endif]-->
<head>

    <!-- Basic meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    @stack('meta')
            <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet"/>
    <!--[if IE 7]>
    <link href="/css/font-awesome/font-awesome-ie7.min.css" rel="stylesheet"/>
    <![endif]-->
    @stack('styles')
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- Web Fonts  -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'/>

    <!-- Javascript -->
    <!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script> -->
    <title>{{ config('app.name', 'Блог PHP-разработчика') }}</title>
    <!-- Internet Explorer condition - HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Header
    ================================================== -->
    <header id="header">

        <!-- Navigation
        ================================================== -->
        <nav class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <!-- Logo -->
                    <a class="brand" href="/">
                        {{ config('app.name', 'Блог PHP-разработчика') }}
                    </a>
                    <ul class="nav">
                        <li><a href="{!! route('articles.index') !!}">Главная</a></li>
                        {{--<li><a href="work.html">Категории</a></li>--}}
                        {{--<li><a href="plans.html">Теги</a></li>--}}
                        <li><a href="{!! route('books.index') !!}">Книги</a></li>
                        @if (!Auth::guest())
                            <li><a href="{!! route('articles.create') !!}">Добавить</a></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">Выйти</a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div><!-- end .container -->
            </div><!-- end .navbar-inner -->
        </nav>

    </header>

    <!-- Content
    ================================================== -->
    <section id="content" class="container">

        <div class="hero-unit">
            <p>{!! $page_description or 'Полезные заметки собраны в одном месте' !!}</p>
        </div>

        @yield('main')
    </section>

    <!-- Footer
    ================================================== -->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <a class="brand" href="https://molchan.me" target="_blank">
                        Molchan.Me
                    </a>
                    <p>
                        Информацию обо мне<br/>
                        и примеры некоторых моих работ<br/>
                        Вы найдете в моем портфолио.

                    </p>
                </div>
                <div class="span4 social-networks">
                    <h3>Мои контакты</h3>
                    <p>
                        <a class="social-network twitter" target="_blank" href="https://twitter.com/MolchanYaroslav"></a>
                        <a class="social-network facebook" target="_blank"
                           href="https://www.facebook.com/yaroslav.molchan"></a>
                        <a class="social-network linkedin" target="_blank"
                           href="https://www.linkedin.com/in/yaroslav-molchan"></a>
                        <a class="social-network gplus2" target="_blank"
                           href="https://plus.google.com/113165765144788622367"></a>
                        <a class="social-network skype" target="_blank" href="skype:yarik_jadson?call"></a>
                    </p>
                </div>
                <div class="span4 newsletter">
                    <h3>Подписка</h3>
                    <p>Подпишитесь на рассылку чтобы первым узнать о новых записях в блоге!</p>
                    <img class="ajax-loader" src="img/ajax-loader.gif" alt=""/>
                    <form method="post" id="newsletter-form">
                        <input type="text" placeholder="Введите E-mail" name="email"/>
                        <input type="hidden" name="bot"/><!-- SPAM protection -->
                        <button type="submit" class="icon-ok" id="newsletter-subscribe"></button>
                    </form>
                </div>
            </div> <!-- end .row -->
        </div> <!-- end .container -->
    </footer><!-- end #footer -->

    <!-- Javascript - Placed at the end of the document so the pages load faster
    ================================================== -->
    <script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
    {{--<script type="text/javascript" src="/js/jquery.autocomplete.js"></script>--}}
    <script type="text/javascript" src="/js/typeahead.bundle.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="/js/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    @stack('scripts')
</body>
</html>		