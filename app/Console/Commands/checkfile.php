<?php

namespace App\Console\Commands;

use App\Models\Peserta;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class checkfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = Peserta::where('file', null)->get();

        $this->info("Mulai pengecekan " . count($data) . " peserta...\n");

        $found = 0;
        $notFound = 0;

        foreach ($data as $item) {
            $finalFilename = $item->nik . '_' . preg_replace('/\s+/', '_', $item->nama) . '.pdf';
            $filePath = 'peserta/' . $finalFilename;

            if (Storage::disk('s3')->exists($filePath)) {
                $item->update(['file' => $finalFilename, 'checkfile' => 1]);
                $this->info("✔️ File ditemukan: $filePath");
                $found++;
            } else {
                $this->warn("❌ File tidak ditemukan: $filePath");
                $notFound++;
            }
        }

        $this->info("\nPengecekan selesai.");
        $this->info("✅ Ditemukan: $found");
        $this->warn("❌ Tidak ditemukan: $notFound");

        return Command::SUCCESS;
    }
}
