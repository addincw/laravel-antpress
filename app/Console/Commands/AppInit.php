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
        $this->line('1/5 generate app key');
        $this->call('key:generate');
        
        $this->line("");
        $this->line('2/5 create app storage link');
        $this->call('storage:link');
        
        $this->line("");
        $this->line('3/5 create new database: ' . env('DB_DATABASE'));
        $this->_createDB();
        $this->line('database ' . env('DB_DATABASE') . ' created');

        $this->line("");
        $this->line('4/5 migrate database: ' . env('DB_DATABASE'));
        $this->call('migrate:fresh');
        $this->line('migrate database ' . env('DB_DATABASE') . ' success');
        
        $this->line("");
        $this->line('5/5 seed master table (user)');
        $this->call('db:seed');
        $this->line('seed master table success');
        
        $this->line("");
        $this->line("\u{2705} Initializing app done");
    }

    private function _createDB()
    {
        $config = [
            '-u ' . env('DB_USERNAME'),
            '-h ' . env('DB_HOST'),
            '-p' . env('DB_PASSWORD'),
        ];

        $commandDropDB = array_merge($config, ['-e "DROP DATABASE IF EXISTS '.env('DB_DATABASE').'"']);
        $processDropDB = Process::fromShellCommandline('mysql '.implode(" ", $commandDropDB));
        $processDropDB->run();
        if (!$processDropDB->isSuccessful()) {
            $this->line($processDropDB->getOutput());
            throw new ProcessFailedException($processDropDB);
        }

        $commandCreateDB = array_merge($config, ['-e "CREATE DATABASE IF NOT EXISTS '.env('DB_DATABASE').'"']);
        $processCreateDB = Process::fromShellCommandline('mysql '.implode(" ", $commandCreateDB));
        $processCreateDB->run();
        if (!$processCreateDB->isSuccessful()) {
            $this->line($processCreateDB->getOutput());
            throw new ProcessFailedException($processCreateDB);
        }
    }
}
