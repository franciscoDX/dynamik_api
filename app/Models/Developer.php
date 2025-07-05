<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Developer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'nickname',
        'name',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'developer_stack');
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
