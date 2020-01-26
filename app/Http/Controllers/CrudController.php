<?php

namespace App\Http\Controllers;

use App\Book_author;
use App\Http\Resources\DeleteBookResource;
use App\Http\Resources\NoResultResource;
use App\Http\Resources\PostBookResource;
use Illuminate\Http\Request;
use App\Article;

use App\Http\Resources\Article as ArticleResource;
use App\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function bookIndex()
    {
        // get books
        //$books = Book::paginate(2);
        $books = db::table('books as bk')
            ->join('book_author as ba', 'ba.book_id', '=', 'bk.id')
            ->join('authors as ar', 'ba.author_id', '=', 'ar.id')
            ->select('bk.id as id', 'bk.name as name', 'bk.isbn as isbn', 'ar.name as authors',
                'bk.country as country', 'bk.number_of_pages as number_of_pages', 'bk.publisher as publisher',
                'bk.release_date as release_date')
            ->get();

        if (count($books) >= 1)
        {
            return BookResource::collection($books);
        }
        else{
            return array(
                "status_code"=> 200,
                "status" => "success",
                "data" => []
            );
        }



    }

    // get author name
    private function getAuthorName($id)
    {
        $query = DB::table('authors')
            ->select('name')
            ->where('id', $id)
            ->get();


        return $query;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created book resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeBook(Request $request)
    {
        // Validate post
        $this->validate($request, [
           'name' => 'required',
            'isbn' => 'required',
            'author_id' => 'required',
            'country' => 'required',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required',
        ]);

        // get author name

        $getAuthor = $this->getAuthorName($request->author_id);

        // check if $getAuthor is more than one row
        if( count($getAuthor) != 1)
        {
            return array(
                "status_code"=> 400,
                "status" => "Bad request",
                "data" => []
            );
        }

        // Loop to get author name
        foreach ($getAuthor as $authorName)
        {
            $author = $authorName->name;
        }

        // Create new Book entry
        $article =  new Book;
        //$article->id = $request->input('id');
        $article->name = $request->input('name');
        $article->isbn = $request->input('isbn');
        $article->country = $request->input('country');
        $article->number_of_pages = $request->input('number_of_pages');
        $article->publisher = $request->input('publisher');
        $article->release_date = $request->input('release_date');
        if($article->save()) {
            $getId = $article->id;
            $book_author = new Book_author;
            $book_author->book_id = $getId;
            $book_author->author_id = $request->input('author_id');
            if($book_author->save())
            {
                $newbie = new Book;
                $newbie->name = $request->input('name');
                $newbie->isbn = $request->input('isbn');
                $newbie->country = $request->input('country');
                $newbie->authors = $author;
                $newbie->number_of_pages = $request->input('number_of_pages');
                $newbie->publisher = $request->input('publisher');
                $newbie->release_date = $request->input('release_date');
                /*$newBook = array(
                    'name' => $request->input('name'),
                    'isbn' => $request->input('isbn'),
                    'authors' => $author,
                    'country' => $request->input('country'),
                    'number_of_pages' => $request->input('number_of_page'),
                    'publisher' => $request->input('publisher'),
                    'release_date' => $request->input('release_date'),
                );*/
                return new PostBookResource($newbie);
            }

        }
    }
    /**
     * Display the specified book resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showBook($id)
    {
        // Get article
       // $article = Book::findOrFail($id);
        $books = db::table('books as bk')
            ->join('book_author as ba', 'ba.book_id', '=', 'bk.id')
            ->join('authors as ar', 'ba.author_id', '=', 'ar.id')
            ->select('bk.id as id', 'bk.name as name', 'bk.isbn as isbn', 'ar.name as authors',
                'bk.country as country', 'bk.number_of_pages as number_of_pages', 'bk.publisher as publisher',
                'bk.release_date as release_date')
            ->where('bk.id', $id)
            ->get();
        // Return single article as a resource
        return  BookResource::collection($books);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBook(Request $request, $id)
    {
        // Validate post
        $this->validate($request, [
            'name' => 'required',
            'isbn' => 'required',
            'author_id' => 'required',
            'country' => 'required',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required',
        ]);

        $getAuthor = $this->getAuthorName($request->author_id);

        if( count($getAuthor) != 1)
        {
            return array(
                "status_code"=> 400,
                "status" => "Bad request",
                "data" => []
            );
        }

        foreach ($getAuthor as $authorName)
        {
            $author = $authorName->name;
        }

        $article = Book::findOrFail($id);
        //$article->id = $id;
        $article->name = $request->input('name');
        $article->isbn = $request->input('isbn');
        $article->country = $request->input('country');
        $article->number_of_pages = $request->input('number_of_pages');
        $article->publisher = $request->input('publisher');
        $article->release_date = $request->input('release_date');
        if($article->save()) {
            return new BookResource($article);
        }
    }

    /**
     * Remove the specified book resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyBook($id)
    {
        // Get article
        $article = Book::findOrFail($id);
        if($article->delete()) {
            return new DeleteBookResource($article);
        }
    }
}
