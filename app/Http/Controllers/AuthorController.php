<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        DB::enableQueryLog();
        $authorWithBooks = Author::with('book.price')->get();
//        dd(DB::getQueryLog());

        return response()->json(['error'=> false, 'message'=>'All Authors with Book record', 'data'=>$authorWithBooks]);
    }
}
