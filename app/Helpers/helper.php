<?

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

function myProfil()
{
    return Auth::user()->peserta;
}
