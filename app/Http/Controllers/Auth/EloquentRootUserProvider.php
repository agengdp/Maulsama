<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;

/**
 *
 */
class EloquentRootUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        $user = parent::retrieveByCredentials($credentials);

        return ($user->hasRole('root') ? null : $user);
    }
}
