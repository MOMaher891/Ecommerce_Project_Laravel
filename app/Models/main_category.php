<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_category extends Model
{
    protected $table = 'main_categories';
    protected $fillable = ['name','slug','photo','translation_lang','translation_of','active'];
    public $timestamps = false;
    use HasFactory;

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function scopeSelection($query){
        return $query->select('id','photo','name','translation_lang','slug','active');
    }

    public function getActive(){
        return $this->active == 1 ? 'مفعل':'غير مفعل';
    }
}
