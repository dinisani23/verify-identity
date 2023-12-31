<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunPython extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:python {script}';


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
        $script = $this->argument('script');
        system('python ' . $script, $return_var);
        if ($return_var == 0) {
            $this->info('Successfully ran the script: ' . $script);
        } 
        else {
            $this->error('An error occurred while running the script: ' . $script);
        }
    }
}
