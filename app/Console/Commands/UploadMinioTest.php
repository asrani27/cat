<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UploadMinioTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'minio:test-upload {filename}';
    protected $description = 'Test upload file dari folder public ke MinIO';

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
        $filename = $this->argument('filename');
        $localPath = public_path($filename);

        if (!file_exists($localPath)) {
            $this->error("File {$filename} tidak ditemukan di folder public/");
            return 1;
        }

        $contents = file_get_contents($localPath);
        $path = 'test/' . basename($filename);

        Storage::disk('minio')->put($path, $contents);

        $this->info("File berhasil diupload ke MinIO: {$path}");
        $this->info("URL: " . Storage::disk('minio')->url($path));

        return 0;
    }
}
