<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table ='languages';
    protected $fillable = ['name','local','abbr','direction','active'];
    public $timestamps = false;
    use HasFactory;
    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function scopeSelection($query){
        return $query->select('id','name','direction','active','abbr');
    }

    public function getActive(){
        return $this->active == 1 ? 'مفعل':'غير مفعل';
    }
}
