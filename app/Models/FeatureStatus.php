<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureStatus extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
  ];

  



}
