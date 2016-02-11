<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'terms';
    protected $guarded = [];

    protected $fillable = ['question', 'answer'];

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'term_id');
    }

    public function assign($values)
    {

    }
}
