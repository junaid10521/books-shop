<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishersWithBooks = Publisher::with('book')->get();
        return response()->json(['error' => false, 'message' => 'Publishers with Books', 'data' => $publishersWithBooks]);
    }
}
