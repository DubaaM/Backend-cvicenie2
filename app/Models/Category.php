<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'color',
    ];

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_category')->withTimestamps();
    }

    public static function getAllCategories()
    {
        return self::all();
    }

    public static function createCategory(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'color' => $data['color'] ?? null,
        ]);
    }

    public static function findCategoryById($id)
    {
        return self::find($id);
    }

    public function updateCategoryData(array $data)
    {
        return $this->update([
            'name' => $data['name'] ?? $this->name,
            'color' => $data['color'] ?? $this->color,
        ]);
    }


    public function deleteCategory()
    {
        $this->notes()->detach();
        return $this->delete();
    }
}
