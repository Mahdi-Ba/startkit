<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;
    protected $fillable =['page_id','title','slug','template_id'
    ];
    public function sub_category()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }
}
