<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

namespace Sebastianlew\Interview\Console;

use Illuminate\Console\Command;

class MigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'interview:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the Interview specifications.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('');
        $this->info('Tables: products');
        $this->comment('A migration that creates "products" tables will be created in database/migrations directory');
        $this->line('');
        if ($this->confirm("Proceed with the migration creation? [Yes|no]")) {
            $this->line('');
            $this->info("Creating migration...");
            if ($this->createMigration()) {
                $this->info("Migration successfully created!");
            } else {
                $this->error(
                    "Coudn't create migration.\n Check the write permissions".
                    " within the database/migrations directory."
                );
            }
            $this->line('');
        }
    }

    /**
     * Create the migration.
     *
     * @return bool
     */
    protected function createMigration()
    {
        $migration_file = base_path('/database/migrations').'/'.date('Y_m_d_His').'_create_products_table.php';
        if (!file_exists($migration_file) && $fs = fopen($migration_file, 'x')) {
            fwrite($fs, file_get_contents(__DIR__ . '/../../migrations/create_products_table.php'));
            fclose($fs);
            return true;
        }
        return false;
    }
}