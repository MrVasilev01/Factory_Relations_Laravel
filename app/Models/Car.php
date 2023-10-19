<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'model',
        'color',
    ];

    public function get_car_info(){
        return $this->name . ' - ' . $this->model . ' - ' .$this->color;
    }


    public function user()
    {
        return $this->hasOne(CarUser::class);
    }

}
