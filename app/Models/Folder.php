<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'user_id',
        'parent_folder_id'
    ];

    public function isChild(): bool
    {
        return $this->parent_folder_id !== null;
    }

    public function isParent(): bool
    {
        return $this->parent_folder_id == null;
    }
}
