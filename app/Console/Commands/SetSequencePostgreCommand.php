<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetSequencePostgreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setsequence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Sequence semua table di postgresql';

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
        // Get all the tables from your database
        $tables = DB::select('SELECT table_name FROM information_schema.tables WHERE table_schema = \'public\' ORDER BY table_name;');

        // Set the tables in the database you would like to ignore
        $ignores = array('admin_setting', 'model_has_permissions', 'model_has_roles', 'password_resets', 'role_has_permissions', 'sessions');

        //loop through the tables
        foreach ($tables as $table) {

            // if the table is not to be ignored then:
            if (!in_array($table->table_name, $ignores)) {

                //Get the max id from that table and add 1 to it
                $seq = DB::table($table->table_name)->max('id') + 1;

                // alter the sequence to now RESTART WITH the new sequence index from above
                DB::select('ALTER SEQUENCE ' . $table->table_name . '_id_seq RESTART WITH ' . $seq);

            }

        }
        return 0;
    }
}
