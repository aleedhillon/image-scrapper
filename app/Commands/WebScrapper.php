<?php

namespace App\Commands;

use Exception;
use Illuminate\Support\Str;
use spekulatius\phpscraper;
use Illuminate\Support\Facades\Storage;
use LaravelZero\Framework\Commands\Command;

class WebScrapper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap 
                            {url : This is the url of the page you want to donwload images from.}
                            {--D|download : Use this flag if you want to download images.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrapp images from a given webpage.';

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
        $url = $this->argument('url');
        $download = $this->option('download');

        $scrapper = new phpscraper();

        $scrapper->go($url);

        $images = $scrapper->images;

        if ($download) {
            $bar = $this->output->createProgressBar(count($images));

            $bar->start();
            $imageDir = 'scrapper/' . Str::slug($url) . time() . '/';

            foreach ($images as $image) {
                Storage::put($imageDir . basename($image), file_get_contents($image));
                $bar->advance();
            }

            $bar->finish();

            $this->info("\r\nThe following images have been downloaded.");
        }

        $images = collect($images)->map(function ($image, $key) {
            return [$key + 1, $image];
        });

        $this->table(['Sr.', 'Image URLs'], $images);

        return 0;
    }
}
