<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org_Activity extends Model
{
    use HasFactory;
    protected $table = 'org_activityies';
    public $timestamps = true;

    protected $fillable = [
        'Organization_Id'
  ];

    /**
     * The relationships that belong to the Activity.
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
    //connects to org activity
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }
    public function organization()
    {
        return $this->hasMany('App\Models\Organization');
    }
}
