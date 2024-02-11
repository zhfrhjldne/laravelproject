<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['kategori'];

    public function kategori () {
        return $this->belongsTo(Kategori::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            $query->whereHas('kategori', function($query) use ($kategori){
                $query->where('id', $kategori);
            });
        });

        $query->when($filters['date'] ?? false, function ($query, $date) {
            $query->where('created_at', 'like', '%' . $date . '%');
        });
    }
}
