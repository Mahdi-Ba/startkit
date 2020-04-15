<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Page extends Model
{
    use HasTags;

    protected $fillable = ['title', 'slug', 'content', 'template_id', 'img', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
