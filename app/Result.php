<?php

namespace App;

use App\Word;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    const RESULT_CORRECT = 1;
    const RESULT_WRONG = 0;

    protected $guarded = [];

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

}
