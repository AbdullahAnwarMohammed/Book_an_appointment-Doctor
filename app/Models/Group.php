<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function GroupPatients($date = NULL)
    {

        $query = $this->hasMany(GroupPateint::class);

        if ($date) {
            $query->whereDate('date', '=', $date);
        }
    
        return $query;
    }
}
