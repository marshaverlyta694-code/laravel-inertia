<?php

use Illuminate\Support\Facades\Broadcast;

// Aturan akses untuk kanal event broadcast.
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    // Pengguna hanya boleh mendengarkan kanal jika ID kanal sama dengan ID akun miliknya.
    return (int) $user->id === (int) $id;
});
