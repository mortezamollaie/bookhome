<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'published_at'
    ];

    protected $appends = ['average_score', 'score_count'];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function review(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageScoreAttribute()
    {
        return $this->review()->avg('score');
    }

    public function getScoreCountAttribute()
    {
        return $this->review()->count();
    }
}
