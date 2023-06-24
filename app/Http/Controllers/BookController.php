<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
        
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'isbn' => 'required|numeric',
            'value' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    

        $book = new Book;
        $book->name = $request->input('name');
        $book->isbn = $request->input('isbn');
        $book->value = $request->input('value');
        $book->save();

        return response()->json(['success' => true], 201);
    }

    public function show($id)
    {
       
        try {
            return Book::findOrFail($id);
        
     
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found', 'success' => false], 404);
        }
    }
 

    public function update(Request $request, $id)
    {

        try {
            $book = Book::findOrFail($id);
            

            if ($request->filled('name')) {
                $validator = Validator::make($request->all(), [
                    'name' => 'string',
                ]);
            
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
            }

            if ($request->filled('isb')) {
                $validator = Validator::make($request->all(), [
                    'isbn' => 'numeric'
                ]);
            
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
            }

            if ($request->filled('value')) {
                $validator = Validator::make($request->all(), [
                    'value' => 'numeric',
                ]);
            
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
            }

            
            $book->update($request->all());

            return response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
    
            return response()->json(['error' => 'Book not found', 'success' => false], 404);
        }
    }

    public function destroy($id)
    {
       
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            
            return response()->json(['success' => true], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found', 'success' => false], 404);
        }
    }
}
