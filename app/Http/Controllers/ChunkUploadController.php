<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChunkUploadController extends Controller
{
    public function upload(Request $request)
    {
        $resumableIdentifier = $request->resumableIdentifier;
        $resumableFilename = $request->resumableFilename;
        $resumableChunkNumber = $request->resumableChunkNumber;

        $tempDir = storage_path('app/chunks/' . $resumableIdentifier);
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $chunkPath = $tempDir . '/' . $resumableChunkNumber;
        $request->file('file')->move($tempDir, $resumableChunkNumber);

        // Cek apakah semua chunk sudah masuk
        $totalChunks = (int) $request->resumableTotalChunks;
        $chunks = glob($tempDir . '/*');
        if (count($chunks) == $totalChunks) {
            $ext = pathinfo($resumableFilename, PATHINFO_EXTENSION);

            $nik = Auth::user()->peserta->nik;
            $nama = Auth::user()->peserta->nama;

            $finalFilename = $nik . '_' . preg_replace('/\s+/', '_', $nama) . '.' . $ext;

            $finalPath = storage_path("app/final/{$finalFilename}");
            //$finalPath = storage_path('app/final/' . $resumableFilename);
            $out = fopen($finalPath, 'ab');
            for ($i = 1; $i <= $totalChunks; $i++) {
                $chunkFile = $tempDir . '/' . $i;
                $in = fopen($chunkFile, 'rb');
                stream_copy_to_stream($in, $out);
                fclose($in);
                unlink($chunkFile);
            }
            fclose($out);
            rmdir($tempDir);

            // Upload ke MinIO setelah file lengkap
            $file = new \Illuminate\Http\File($finalPath);
            Storage::disk('minio')->putFileAs('peserta', $file, $finalFilename);
            unlink($finalPath);

            return response()->json(['done' => true]);
        }
        Auth::user()->peserta->update(['file' => $finalFilename]);
        return response()->json(['chunkReceived' => true]);
    }
}
