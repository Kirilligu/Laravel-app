<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'is_published', 'publish_at'];
    protected $casts = [
        'is_published' => 'boolean',
        'publish_at' => 'datetime',
    ];

    /**
     *
     * @return bool
     */
    public function shouldBePublished(): bool
    {
        return $this->publish_at <= now() && !$this->is_published;
    }

    /**
     */
    public function publish(): void
    {
        $this->is_published = true;
        $this->save();
    }
public function comments()
{
    return $this->hasMany(Comment::class);
}

}
