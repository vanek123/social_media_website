<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profileImage()
    {
        $mediaPath = ($this->media) ? $this->media : 'profile/0AYsODwWnuTnJ9n2EtmJpbTXFHg8PQ7FOd9rKX57.jpg';
        return '/storage/' . $mediaPath;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
