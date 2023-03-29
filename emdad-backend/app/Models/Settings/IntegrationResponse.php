<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegrationResponse extends Model
{
    use HasFactory;
    protected $table="integration_responses";

    protected $fillable=['record','model','response'];
}
