<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("name", "Hema")->first();
            DB::table('products')->insert([
                'prod_name' => "Sounder",
                'prod_price' => 2000,
                'user_id' =>$user->id,
                
            ]);
            
    }
}
