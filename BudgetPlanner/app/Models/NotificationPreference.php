<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_new_post',
        'inapp_comment',
        'email_weekly_summary',
        // ... otros campos
    ];

    protected $casts = [
        'email_new_post' => 'boolean',
        'inapp_comment' => 'boolean',
        'email_weekly_summary' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}