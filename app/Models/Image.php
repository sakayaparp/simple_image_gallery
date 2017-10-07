<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table = 'image';
    protected $fillable = [
        'user_id',
        'filename',
        'filename_real',
        'filesize',
        'filetype',
    ]; 
}
