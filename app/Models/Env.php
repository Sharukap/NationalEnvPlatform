<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Env extends Model
{
    use HasFactory;
    protected $table = 'eco_systems';

    protected $fillable = ['type_id','title', 'polygon','description', 'created_by_user_id', 'status',];

    public function ecosystems_type()
    {
        return $this->belongsTo('App\Models\Env_type', 'type_id');
    }
}
