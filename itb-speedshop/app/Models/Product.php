<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi manual
    protected $fillable = [
    'name', 
    'slug', 
    'description', 
    'price', 
    'stock', 
    'category', 
    'image'
];

    // Tambahkan method ini di dalam class Product
    public function getCategoryLabelAttribute()
    {
        $labels = [
            'Shock Depan' => 'Shock Depan',
            'Shock Belakang' => 'Shock Belakang',
            'Velg' => 'Velg',
            'Ban' => 'Ban',
            'Piringan' => 'Piringan',
            'Kaliper Rem' => 'Kaliper Rem',
            'Master Rem' => 'Master Rem',
            'Selang Rem' => 'Selang Rem',
            'Knalpot' => 'Knalpot',
            'Part Part CVT' => 'Part CVT',
            'Filter Udara' => 'Filter Udara',
            'Busi' => 'Busi',
            'Cover Radiator' => 'Cover Radiator',
            'Cover Knalpot' => 'Cover Knalpot',
            'Hugger' => 'Hugger',
            'Visor' => 'Visor',
            'Body Kasar' => 'Body Kasar',
            'Karpet Dek' => 'Karpet Dek',
            'Emblem' => 'Emblem',
            'Baut' => 'Baut',
            'Spion' => 'Spion',
            'Handgrip' => 'Handgrip',
            'Jalu Stang' => 'Jalu Stang',
            'Cover Jok' => 'Cover Jok'
        ];
        
        return $labels[$this->category] ?? $this->category;
    }
}