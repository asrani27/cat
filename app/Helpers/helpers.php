<?php

namespace App\Helpers;

use App\Models\Hotline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Helper
{
    public function hotline()
    {
        return Hotline::first()->nomor;
    }
}
