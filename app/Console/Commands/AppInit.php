<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AppInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init {--dev}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize app environment and databases';

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
     * @return mixed
     */
    public function handle()
    {
        $this->line('1/4 generate app key');
        $this->call('key:generate');
        
        $this->line("");
        $this->line('2/4 create app storage link');
        $this->call('storage:link');
        
        $this->line("");
        $this->line('3/4 create new database: ' . env('DB_DATABASE'));
        // DB::statement('DROP DATABASE IF EXISTS ' . env('DB_DATABASE'));
        $this->_createDB();
        $this->line('database ' . env('DB_DATABASE') . ' created');

        // $this->line("");
        // $this->line('4/4 migrate database: ' . env('DB_DATABASE'));
        // $this->call('migrate:fresh');
        // $this->line('migrate database ' . env('DB_DATABASE') . ' success');
        
        $this->line("");
        $this->line("\u{2705} Initializing app done");
    }

    private function _createDB()
    {
        $config = [
            '-h ' . env('DB_HOST'),
            '-u ' . env('DB_USERNAME'),
            '-p' . env('DB_PASSWORD'),
        ];

        $processDropDB = Process::fromShellCommandline('mysql '.implode(" ", $config).' -e "DROP DATABASE IF EXISTS '.env('DB_DATABASE').'"');
        $processDropDB->run();
        if (!$processDropDB->isSuccessful()) {
            $this->line($processDropDB->getOutput());
            throw new ProcessFailedException($processDropDB);
        }

        $processCreateDB = Process::fromShellCommandline('mysql '.implode(" ", $config).' -e "CREATE DATABASE IF NOT EXISTS '.env('DB_DATABASE').'"');
        $processCreateDB->run();
        if (!$processCreateDB->isSuccessful()) {
            $this->line($processCreateDB->getOutput());
            throw new ProcessFailedException($processCreateDB);
        }
    }
}
