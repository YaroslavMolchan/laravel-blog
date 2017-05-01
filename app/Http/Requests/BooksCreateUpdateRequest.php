<?php

namespace App\Http\Requests;

use App\Repositories\BookAuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Foundation\Http\FormRequest;

class BooksCreateUpdateRequest extends FormRequest
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
     * BooksCreateUpdateRequest constructor.
     * @param BookRepository $books
     * @param BookAuthorRepository $authors
     */
    public function __construct(BookRepository $books, BookAuthorRepository $authors)
    {
        $this->books = $books;
        $this->authors = $authors;
        
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'authors_id' => 'required',
            'link' => 'url',
            'image' => 'image'
        ];
    }

    public function persist($id = null)
    {
        $data = [
            'title' => $this->input('title'),
            'link' => $this->input('link'),
            'description' => $this->input('description')
        ];
        if ($this->file('image')) {
            $data['image'] = $this->file('image')->store('books');
        }
        if (is_null($id)) {
            $book = $this->books->create($data);
        }
        else {
            $book = $this->books->update($data, $id);
        }
        $authors_id = [];
        foreach ($this->authors_id as $id) {
            if (!ctype_digit($id)) {
                $id = $this->authors->updateOrCreate(['name' => $id])->id;
            }
            array_push($authors_id, $id);
        }
        $book->authors()->sync($authors_id);
    }
}
