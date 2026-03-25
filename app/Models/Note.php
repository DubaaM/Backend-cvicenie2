<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'notes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'status',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'note_category')->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // jedna poznámka má viac úloh
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'note_id', 'id');
    }

    public function pin()
    {
        $this->update(['is_pinned' => true]);
        return $this;
    }

    public function unpin()
    {
        $this->update(['is_pinned' => false]);
        return $this;
    }

    public function publish()
    {
        $this->update(['status' => 'published']);
        return $this;
    }

    public function archive()
    {
        $this->update(['status' => 'archived']);
        return $this;
    }

    public static function searchPublished(string $q, int $limit = 20)
    {
        $q = trim($q);

        return static::query()
            ->where('status', 'published')
            ->where(function (Builder $x) use ($q) {
                $x->where('title', 'like', "%{$q}%")
                    ->orWhere('body', 'like', "%{$q}%");
            })
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get();
    }
}
