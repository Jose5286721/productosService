<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Medida extends Model{
    protected $fillable = [
        "unidad","empresa_id"
    ];
}
