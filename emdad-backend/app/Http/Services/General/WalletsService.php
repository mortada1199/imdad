<?php

namespace App\Http\Services\General;


class WalletsService
{
    public static function create($profile)
    {
        // dd($profile);
        $types = [
            'Buyer' => 'receiver',
            'Supplier' => 'sender',
        ];
        // dd($profile);
        $profile->wallet()->create(['profile_id' => $profile->id, 'type' => $types[$profile->type]]);
    }
}
