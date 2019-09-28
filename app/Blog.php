<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Blog extends Model
{
    use HasTags;

    protected $fillable = ['title','slug','content','category_id','img'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
