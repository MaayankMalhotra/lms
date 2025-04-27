<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = ['title', 'description', 'image', 'category', 'slug', 'published_at', 'created_by'];

    protected $dates = ['published_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->image, 'data:image')) {
            return $this->image; // Return base64 directly
        }
        return route('news.image', $this->id); // Serve image via controller
    }
}