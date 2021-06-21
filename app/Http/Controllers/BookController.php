<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('price','author')->get();

        return response()->json(['error'=> false, 'message'=>'All Books record', 'data'=>$books]);
    }

    public function searchBookByName(Request $request){
//        dd($request->all());
//        DB::enableQueryLog();
//        $books = Book::with('price')
//            ->where('title','like','%' .$title. '%')
//            ->orWhere('first_name','like','%' .$title. '%')->get();

//        $books2 = Book::with('price')->orWhereHas('author', function ($query) use ($request) {
//
//            $query->where('title','like','%' .$request. '%')->orWhere('first_name', 'like', '%' .$request. '%');
//
//        })->get();
//        dd(DB::getQueryLog());

        $request = $request->all();
        DB::enableQueryLog();
        $books = Book::with(['price', 'author'])->SearchBook($request)->get();
//        dd(DB::getQueryLog());

        return response()->json(['error'=> false, 'message'=>'Books record', 'data'=>$books]);
//        return view('welcome')->with(['books'=>$books]);


//        return response()->json(['error'=> false, 'message'=>'All Books with book title & author record', 'data'=>$books2]);

//        dd(DB::getQueryLog());
    }

}
