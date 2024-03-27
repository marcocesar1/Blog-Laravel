<?php

namespace App\Models;

use App\Traits\ParseArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Article extends Model
{
    use HasFactory, ParseArticle;

    protected $fillable = [
        'title',
        'description',
        'url',
        'url_to_image',
        'published_at',
        'content',
        'user_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
