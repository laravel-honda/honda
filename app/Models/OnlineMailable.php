<?php

namespace App\Models;

use App\Models\Concerns\WithUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use URL;

class OnlineMailable extends Model
{
    use WithUuid;

    protected $casts = ['content' => 'encrypted'];

    public function getSignedUrl(): string
    {
        return URL::temporarySignedRoute('honda.mails.show', Carbon::parse($this->expires_at), [
            'onlineMailable' => $this,
        ]);
    }
}
