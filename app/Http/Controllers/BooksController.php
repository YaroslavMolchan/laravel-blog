<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksCreateUpdateRequest;
use App\Repositories\BookAuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Container\Container;

class BooksController extends Controller
{
    /**
     * @var BookRepository
     */
    private $books;
    /**
     * @var BookAuthorRepository
     */
    private $authors;

    /**
     * Books constructor
     * @author MY
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->books = $container->make(BookRepository::class);
        $this->books = $container->make(BookAuthorRepository::class);

        $this->middleware('auth')->only(['create']);
    }

    public function index()
    {
        $books = $this->books->orderBy('created_at', 'DESC')->paginate(10);
        $page_description = 'Список прочитанных книг';
        return view('books.index', compact('books', 'page_description'));
    }

    public function create()
    {
        $submitButtonText = 'Create';
        $authors = $this->authors->pluck('name', 'id');

        return view('books.create', compact('submitButtonText', 'authors'));
    }

    public function store(BooksCreateUpdateRequest $form)
    {
        $form->persist();

        return [
            'ok' => true,
            'url' => route('books.index')
        ];
    }
}
