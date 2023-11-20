<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        $books = Book::query()->paginate(20);
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse {

        $validator = Validator::make($request->all() ,[
            'title' => 'string|required',
            'author' => 'string|required',
            'publication_year' => 'integer|required',
            'genre' => 'string|required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 401);
        } else {
            Book::class::create([
                'title' =>$request->title,
                'author' => $request->author,
                'publication_year' => $request->publication_year,
                'genre' => $request->genre
            ]);
            return response()->json([
                'message' => 'Book Added',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::query()->find($id);

        if (isset($book)) {
            return response()->json([
                'message' => 'Book found!',
                'data' => new BookResource($book)
            ], 200);
        } else {
            return response([
                'message' => 'No book with that id found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse {
        $validator = Validator::make($request->all() ,[
            'title' => 'string|nullable',
            'author' => 'string|nullable',
            'publication_year' => 'integer|nullable',
            'genre' => 'string|nullable'
        ]);

        $oldBook = Book::query()->find($id);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 401);
        } else {

        $book = Book::query()
            ->where('id', $id)
            ->update([
                'title' =>$request->title ?? $oldBook->title,
                'author' => $request->author ?? $oldBook->author,
                'publication_year' => $request->publication_year ?? $oldBook->publication_year,
                'genre' => $request->genre ?? $oldBook->genre
            ]);

            return response()->json([
                'message' => 'Book updated!',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::query()->find($id);
        if (isset($book)) {
            $book->delete();
            return response()->json([
                'message' => 'Book deleted',
            ], 200);
        } else {
            return response()->json([
                'message' => 'No book found with that id',
            ], 404);
        }
    }
}
