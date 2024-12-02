<?php

namespace Middlewares;

class Middleware
{
    const MAP = [
        'auth'  => Auth::class,
        'admin' => Admin::class,
    ];
}
