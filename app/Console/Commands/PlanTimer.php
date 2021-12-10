<?php

namespace App\Console\Commands;

use App\Models\ActiveUser;
use App\Models\CollectGem;
use App\Models\Memorial;
use App\Models\Player;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Auth;

class PlanTimer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Plan timer is started.';

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
        $current_date=date('Y-m-d');

        $memorials=Memorial::all();
        foreach($memorials as $memorial){
            if($memorial->plan_id==2){
                if($current_date-$memorials->payment_created_date>30){
                    Memorial::whereId($memorials->id)->update(['plan_id'=>1,'payment_status'=>0]);
                }
            }else if($memorial->plan_id==3){
                if($current_date-$memorials->payment_created_date>365){
                    Memorial::whereId($memorials->id)->update(['plan_id'=>1,'payment_status'=>0]);
                }
            }
        }
        
                 
    }
}
