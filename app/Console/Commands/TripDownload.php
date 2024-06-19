<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TripDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:trip-download';

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
        $files = File::files(storage_path('trips'));

        foreach ($files as $file) {
            $slug = $file->getFilenameWithoutExtension();

            $trip = json_decode(file_get_contents(storage_path('trips/'.$slug.'.json')), true);

            @mkdir(storage_path('app/public/trips/'.$slug), 0777, true);

            if (!file_exists(storage_path('app/public/trips/'.$slug.'/'.$trip['trip']['pictureGuid'].'_original.jpg'))) {
                file_put_contents(storage_path('app/public/trips/'.$slug.'/'.$trip['trip']['pictureGuid'].'_original.jpg'), file_get_contents('https://www.journiapp.com/picture/'.$trip['trip']['pictureGuid'].'_original.jpg'));
            }

            foreach ($trip['entries'] as $entry) {
                foreach ($entry['pictures'] as $picture) {

                    if (!file_exists(storage_path('app/public/trips/'.$slug.'/'.$picture['guid'].'_ret.jpg'))) {

                        try {
                            file_put_contents(storage_path('app/public/trips/'.$slug.'/'.$picture['guid'].'_ret.jpg'), file_get_contents('https://www.journiapp.com/picture/'.$picture['guid'].'_ret.jpg'));
                            file_put_contents(storage_path('app/public/trips/'.$slug.'/'.$picture['guid'].'_original.jpg'), file_get_contents('https://www.journiapp.com/picture/'.$picture['guid'].'_original.jpg'));

                            usleep(rand(0, 100));
                        } catch (\ErrorException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }
        }
    }
}
