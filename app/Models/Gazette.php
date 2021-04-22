<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gazette extends Model
{
    use HasFactory;
    protected $table = 'gazettes';

    protected $fillable = [
        'title',
        'gazette_number',
        'gazetted_date',
        'degazetted_date',
        'organizations',
        'content',
    ];

    protected $attributes = [
        'degazetted_date' => NULL,
    ];

    protected $casts =[
          'organizations' =>'array',
     ];

    public function development_projects()
    {
        return $this->hasMany('App\Models\Development_Project');
    }

    public function land_parcels()
    {
        return $this->belongsToMany(Land_Parcel::class, 'Land_Has_Gazette');
    }
}
