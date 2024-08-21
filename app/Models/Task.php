<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Task extends Model
{
    use HasFactory;

    protected $dates = ['due_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Scope a query to only include tasks of a given status.
     *
     * @param  Builder  $query
     * @param  string  $status
     * @return Builder
     */
    public function scopeStatus($query, $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to order tasks by priority.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeOrderByPriority($query): Builder
    {
        return $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
    }

    // Mutator to set the due_date using Jalali date
    public function setDueDateAttribute($value): void
    {
        $this->attributes['due_date'] = Jalalian::fromFormat('Y/m/d', convertPersianToEnglishNumbers($value))->toCarbon();
    }

    // Accessor to get the due_date in Jalali format
    public function getDueDateAttribute($value): string
    {
        return Jalalian::fromCarbon(new \Carbon\Carbon($value))->format('Y/m/d');
    }
}
