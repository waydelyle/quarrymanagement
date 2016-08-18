<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'vehicle/delete',
        'auth/login',
        'auth/register',
        'diesel/add',
        'diesel/subtract',
        'diesel/delete',
        'oil/add',
        'oil/subtract',
        'oil/delete',
        'history/diesel',
        'history/oil'
    ];
}
