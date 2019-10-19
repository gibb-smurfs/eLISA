<?php

namespace App\Providers;

class TripcodeProvider
{
    public static function crypt(string $username)
    {
        if (!$username || trim($username) . length == 0) return 'Anonymous';
        return substr(hash('sha256', $username), -20);
    }
}
