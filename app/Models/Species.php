<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Species extends Model

{
    use HasFactory;
    protected $table = 'species_information';

    protected $fillable = [
        'type', 'title', 'polygon', 'scientefic_name', 'habitats', 'taxa', 'description', 'status_id',
    ];

    protected $attributes = [
        'photos' => "{}",
    ];
    protected $casts = [
        'habitats' => 'array',
        'taxa' => 'array',
    ];

    public function environment_restoration_species()
    {
        return $this->hasMany('App\Models\EnvironmentRestorationSpecies');
    }
}
