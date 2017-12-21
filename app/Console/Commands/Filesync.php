<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * Class AutomatedCharges automatically charges merchants when necessary
 * @package App\Console\Commands
 */
class Filesync extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preskok:syncfiles {';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync files on Preskok';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(sprintf('*** STARTING %s ***', __CLASS__));

        $bucket = $this->ask('Which directory do you want to sync?');

        $dir = getcwd() . '/public/filesync/' . $bucket;

        $files = File::files($dir);

        Config::set('filesystems.disks.s3.bucket', $bucket);

        // Upload files to AWS S3
        foreach ($files as $file) {
            $filePath = pathinfo($file)['basename'];
            $exists = Storage::disk('s3')->has($filePath);
            if (!$exists) {
                Storage::disk('s3')->put($filePath, File::get($file), 'public');
            }
        }

        // Get all files from AWS S3
        $files = Storage::disk('s3')->files();
        foreach ($files as $file) {
            $exists = is_file($dir . '/' . $file);
            if (!$exists) {
                $contents = Storage::disk('s3')->get($file);
                File::put($dir . '/' . $file, $contents);
            }
        }

        $this->info(sprintf('*** FINISHED %s ***', __CLASS__));
    }

}