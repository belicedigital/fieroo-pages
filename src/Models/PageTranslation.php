<?php

namespace Fieroo\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Fieroo\Pages\Models\Page;

class PageTranslation extends Model
{
    use HasFactory;

    public $table = 'pages_translations';
    public $timestamps = false;

    protected $fillable = [
        'locale',
        'title',
        'slug',
        'description',
        'content',
        'is_published',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
