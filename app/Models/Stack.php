<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stack extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function developers()
    {
        return $this->belongsToMany(Developer::class, 'developer_stack');
    }
}
