<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Gradebook extends Model
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $guarded = false;
	protected $fillable = [];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
