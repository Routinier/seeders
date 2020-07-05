<?php

namespace Routinier\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class DatabaseSeeder
 *
 * @package Routinier\Seeders
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::connection()->disableQueryLog();
        Model::unguard();

        $this->truncateAll();
    }

    public function truncateAll(): void
    {
        Schema::disableForeignKeyConstraints();

        collect(DB::select("SHOW FULL TABLES WHERE Table_Type = 'BASE TABLE'"))
            ->map(static function (stdClass $tableProperties): string {
                return get_object_vars($tableProperties)[key($tableProperties)];
            })
            ->reject(static function (string $tableName): bool {
                return $tableName === 'migrations';
            })
            ->each(static function (string $tableName): void {
                DB::table($tableName)->truncate();
            });

        Schema::enableForeignKeyConstraints();
    }
}