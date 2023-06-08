<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTenantMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migration {migration_name} {--create=} {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new tenant migration file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('make:migration', [
            'name' => $this->argument('migration_name'), 
            '--path' => '/database/migrations/tenant',
            '--create' => $this->option('create'),
            '--table' => $this->option('table')
        ]);
    }
}
