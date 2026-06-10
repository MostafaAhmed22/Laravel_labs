<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Tags\HasTags;


class Post extends Model
{
    use Sluggable;
     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    use HasFactory;
    use HasTags;
    protected $fillable = ['title', 'description', 'user_id', 'slug'];
    //return comments of the post
    function comments(){
        return $this->hasMany(Comment::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    use SoftDeletes;
}
