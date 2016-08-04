<?php use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oil_types')->insert([
            'id' => 1,
            'slug' => 'hydrolic',
            'label' => 'Hydrolic',
        ]);

        DB::table('oil_types')->insert([
            'id' => 2,
            'slug' => 'engine',
            'label' => 'Engine',
        ]);

        DB::table('oil_types')->insert([
            'id' => 3,
            'slug' => '80w90',
            'label' => '80w90',
        ]);

        DB::table('oil_types')->insert([
            'id' => 4,
            'slug' => 'agritrack-15w40',
            'label' => 'Agritrack 15w40',
        ]);

        DB::table('oil_types')->insert([
            'id' => 5,
            'slug' => 'transfluid-to-4-sae-40',
            'label' => 'Transfluid TO 4 Sae 40',
        ]);

        DB::table('oil_types')->insert([
            'id' => 6,
            'slug' => 'atf',
            'label' => 'ATF',
        ]);

        DB::table('vehicles')->insert([
            'id' => 1,
            'registration' => 'no-vehicle',
            'user_id' => 1,
        ]);
    }
}
