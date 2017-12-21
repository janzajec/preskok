<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Log;

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

        // Check files on Local
        foreach ($files as $file) {
            $fileName = pathinfo($file)['basename'];

            if (!Log::where('bucket', $bucket)->where('filename', $fileName)->exists()) {
                $log = new Log();
                $log->bucket = $bucket;
                $log->filename = $fileName;
                $log->action = 'local';
                $log->save();
            }
        }

        // Check files on AWS S3
        $files = Storage::disk('s3')->files();
        foreach ($files as $file) {

            if (!Log::where('bucket', $bucket)->where('filename', $file)->exists()) {
                $log = new Log();
                $log->bucket = $bucket;
                $log->filename = $file;
                $log->action = 'amazon';
                $log->save();
            }
        }

        // Sync to local
        $files = Log::where('bucket', $bucket)->where('action', 'amazon')->get();

        foreach ($files as $file) {
            $contents = Storage::disk('s3')->get($file->filename);
            if (File::put($dir . '/' . $file->filename, $contents)) {
                $log = Log::find($file->id);
                $log->action = 'synced';
                $log->save();
            }

        }

        // Sync to AWS
        $files = Log::where('bucket', $bucket)->where('action', 'local')->get();

        foreach ($files as $file) {

            if (Storage::disk('s3')->put($file->filename, File::get($dir . '/' . $file->filename), 'public')) {
                $log = Log::find($file->id);
                $log->action = 'synced';
                $log->save();
            }
        }

        $this->info(sprintf('*** FINISHED %s ***', __CLASS__));
    }

}