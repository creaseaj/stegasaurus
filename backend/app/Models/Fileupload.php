<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Fileupload extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename'
    ];

    public function getStoragePathAttribute()
    {
        return 'steg-' . $this->id;
    }

    public function runSteghide()
    {
        if (!Storage::exists($this->storage_path)) {

            Storage::makeDirectory($this->storage_path);
            $command = "cd /var/www/html/storage/app/steg-" . $this->id . "/ && steghide extract -sf /var/www/html/public/images/" . $this->filename . " -p ''";
            $files = Storage::allFiles($this->storage_path);
            $output = shell_exec($command);
            $output = Storage::get('steg/test.txt');
            return $files;
        } else {
            if (count(Storage::allFiles($this->storage_path))) {

                return Storage::get(Storage::allFiles($this->storage_path)[0]);
            } else {
                Storage::deleteDirectory($this->storage_path);
            }
        }
    }

    public function hideText($text)
    {
        Storage::makeDirectory('steg');
        Storage::put('steg/test.txt', $text);
        logger(Storage::get('steg/test.txt'));
        $command = "steghide embed -cf /var/www/html/public/images/" . $this->filename . " -ef  /var/www/html/storage/app/steg/test.txt -p ''";
        exec($command, $output, $result_code);
        Storage::delete('steg/test.txt');
        return $output;
    }
}
