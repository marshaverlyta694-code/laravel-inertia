<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Mendefinisikan perintah Artisan berbasis closure yang tersedia di terminal.
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    // Menampilkan kutipan inspiratif sebagai keluaran perintah.
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
