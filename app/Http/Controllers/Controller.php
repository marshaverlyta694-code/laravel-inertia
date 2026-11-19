<?php

namespace App\Http\Controllers;

// Trait ini menyediakan pemeriksaan otorisasi dan validasi yang dapat dipakai controller.
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Controller dasar untuk controller lain di aplikasi.
class Controller extends BaseController
{
    // Membagikan fitur otorisasi dan validasi kepada semua controller turunannya.
    use AuthorizesRequests, ValidatesRequests;
}
