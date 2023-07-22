<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpMandiri extends Model
{
    protected $table ="ppmandiri";
    protected $guarded = [];
    use HasFactory;

    public function bukus(){
        return $this->hasMany(DataBuku::class);
    }
}
