<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printing extends Model
{
    use HasFactory;
    
    // Ini wajib agar data bisa masuk ke database
protected $fillable = ['queue_number', 'filename', 'file_path', 'type', 'status', 'ip_address'];}