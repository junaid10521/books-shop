<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;

    public function price(){
        return $this->hasOne(Price::class, 'book_id', 'id');
    }

    public function author(){
        return $this->hasOne(Author::class, 'book_id', 'id');
    }

    public function publisher(){
        return $this->hasOne(Publisher::class, 'book_id', 'id');
    }

    public function scopeSearchBook($q, $request){
//        dd($request);
        $q->when(isset($request['title']) && $request['title'] != '',function($q) use($request){
                $q->where('title','like','%'.$request['title'].'%');
        })->when(isset($request['author']) && $request['author'] != '',function($q) use($request){
            $q->orWhereHas('author', function ($q) use ($request){
                $q->where('first_name','like','%'.$request['author'].'%');
            });
        })->when(isset($request['price']) && $request['price'] != '',function($q) use($request){
            $q->orWhereHas('price', function ($q) use ($request){
                $q->where('price', '=', $request['price']);
            });
        })->when(isset($request['date']) && $request['date'] != null ,function($q) use($request){
            $q->orWhereDate('created_at', $request['date']);
        });




//        ->whereHas('author', function ($q) use ($request){
//            $q->when(isset($request['name']) && $request['name'] != null ,function($q) use($request){
//                $q->orWhere('first_name','like','%'.$request['name'].'%');
//            });
//        })->when(isset($request['date']) && $request['date'] != null ,function($q) use($request){
//            $q->orWhere('created_at', 'LIKE', '%' . $request['date'] . '%');
//        })->whereHas('price', function ($q) use ($request){
//            $q->when(isset($request['price']) && $request['price'] != null,function($q) use($request){
//                $q->where('price', '=', $request['price']);
//            });
//        });




//        $ke->orWhere('title', 'LIKE', '%' . $request['search'] . '%')
//            ->orWhere('created_at', 'LIKE', '%' . $request['search'] . '%')
//            ->orWhereHas('price', function ($query) use ($request){
//                $query->where('price', '=', $request['search']);
//            })
//            ->orWhereHas('author', function ($query) use ($request){
//                $query->where('first_name', 'LIKE', '%' . $request['search'] . '%');
//            });
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}
