<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeedSampling extends Model
{
    protected $fillable = [
        'request_no',
        'lab_no',
        'crop',
        'variety',
        'source',
        'lot_no',
        'weight_of_seed_lot',
        'no_of_bags',
        'date_harvested',
        'container',
        'date_of_application',
        'moisture_content',
        'physical_purity',
        'germination',
        'varietal_purity',
        'seed_health',
        'ttc',
        'others',
        'fname',
        'mname',
        'lname',
        'ename',
        'name_of_company',
        'address',
        'purpose',
        'remarks',
        'created_by',
        'updated_by',
        'status'
    ];
}
