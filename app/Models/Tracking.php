<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = "truck_tracking";

    protected $fillable = ["no_pol", "no_surat_jalan", "driver", "suhu", "foto"];
}
