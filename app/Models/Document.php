<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'document_no', 'document_subject', 'status', 'remark', 'created_by', 'created_at', 'updated_by', 'updated_at',
    ];

    public function getRouteKeyName()
    {
        return 'document_no';
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'username', 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'username', 'updated_by');
    }
}
