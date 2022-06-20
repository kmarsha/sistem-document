<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDetail extends Model
{
    use HasFactory;

    protected $table = 'document_detail';

    protected $fillable = [
        'document_no', 'nama_nasabah', 'amount'
    ];
}
