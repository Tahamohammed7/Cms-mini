<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Tag;

class Post extends Model
{
	use SoftDeletes;
   protected $fillable = ['title','description', 'content', 'image', 'category_id', 'user_id'];


   public function category()
{
	return $this->belongsTo(Category::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function tags()
{
	return $this->belongsToMany(Tag::class);
}
public function hasTag($tagid)
{
    return in_array($tagid, $this->tags->pluck('id')->toArray());
}

}


