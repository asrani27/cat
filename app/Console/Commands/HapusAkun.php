<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Peserta;
use Illuminate\Console\Command;

class HapusAkun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hapus-akun';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nikList = Peserta::whereNull('file')->pluck('nik');
        $total = $nikList->count();

        $this->info("Total data user yang akan dihapus: $total");

        User::whereIn('username', $nikList)->delete();

        $this->info("Penghapusan selesai.");
    }
}
