<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
      $this->call(GroundTableSeeder::class);
   //   $this->call(ActivityTableSeeder::class);
   //     $this->call(AccountTableSeeder::class);
      $this->call(WorkerTableSeeder::class);
      $this->call(Type_activityTableSeeder::class);
         $this->call(AccountingTableSeeder::class);
        $this->call(CropTableSeeder::class);
       $this->call(ProductTableSeeder::class);
         $this->call(BayerTableSeeder::class);
        $this->call(TypeAccountSeeder::class);
   //     $this->call(ProductApplySeeder::class); 
   //     $this->call(SaleTableSeeder::class);
        $this->call(CompetenceSeeder::class);

    }
}
