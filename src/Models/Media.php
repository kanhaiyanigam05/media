<?php

namespace Media\Uploader\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['image', 'alt', 'title', 'type'];
}
