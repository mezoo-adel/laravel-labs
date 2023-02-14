<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{

    use HasFactory; # generate dump data
    use SoftDeletes;

    protected $fillable = ['title','description','user_id','image'];
    protected $guarded = [
        '_token'
    ];

    function news_owner(){
        return $this->belongsTo(User::class,'user_id');
    }
}
