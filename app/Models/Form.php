<?php

namespace App\Models;

use App\Enums\FormStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => FormStatus::class,
    ];

    protected $fillable = [
        'users_id',
        'meeting_date',
        'meeting_time',
        'meeting_topic',
        'meeting_room_name',
        'notebook',
        'speaker',
        'contact_email',
        'contact_name',
        'institution',
        'contact_number',
        'เลขที่หนังสือ',
        'status',
        //create comment section ?
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
