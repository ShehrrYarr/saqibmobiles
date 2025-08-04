<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile_name',
        'imei_number',
        'sim_lock',
        'color',
        'storage',
        'cost_price',
        'selling_price',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function original_owner()
    {
        return $this->belongsTo(User::class);
    }
    public function transfers()
    {
        return $this->hasMany(mobile_transfer::class);
    }
    public function company()
{
    return $this->belongsTo(Company::class);
}
public function group()
{
    return $this->belongsTo(Group::class);
}
public function mobileName()
{
    return $this->belongsTo(MobileName::class, 'mobile_name_id');
}

}
