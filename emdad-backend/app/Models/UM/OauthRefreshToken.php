<?php

namespace App\Models\UM;

use Illuminate\Database\Eloquent\Model;

class OauthRefreshToken extends Model
{

    public function oauthAccessToken()
    {
        return $this->belongsTo('\App\Models\UM\OauthAccessToken');
    }

}
