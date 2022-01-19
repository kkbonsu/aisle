<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
    
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    protected $fillable = array('name', 'price', 'area', 'address', 'bedrooms', 'garages', 'bathrooms', 'furnished', 'negotiable', 'type_id', 'category_id');
}
