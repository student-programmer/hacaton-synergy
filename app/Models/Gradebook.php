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

	public function student()
	{
		return $this->belongsTo(Student::class);
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}
