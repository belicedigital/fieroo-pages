<?php

namespace Fieroo\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Fieroo\Pages\Models\PageTranslation;

class Page extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }
}
