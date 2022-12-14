<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function instances()
    {
        return $this->belongsToMany(User::class, 'quiz_instances', 'quiz_id', 'user_id')
            ->withPivot('current_question_id', 'answers')
            ->withTimestamps();
    }
}
