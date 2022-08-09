<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('shipping_companies')->truncate();
        DB::table('shipping_company_country')->truncate();
        Schema::enableForeignKeyConstraints();

        $sh01 = ShippingCompany::create([
            'name'      => 'Aramex Inside',
            'code'      => 'ARA',
            'description' => '8 - 10 days',
            'fast'      => false,
            'cost'      => '15.00',
            'status'    => true,
        ]);
        $sh01->countries()->attach([194]);


        $sh02 = ShippingCompany::create([
            'name'      => 'Aramex Inside Speed shipping',
            'code'      => 'ARA-SPD',
            'description' => '1 - 3 days',
            'fast'      => true,
            'cost'      => '25.00',
            'status'    => true,
        ]);
        $sh02->countries()->attach([194]);




        $countriesIds = Country::where('id', '!=', 194)->pluck('id')->toArray();

        $sh03 = ShippingCompany::create([
            'name'      => 'Aramex Outside',
            'code'      => 'ARA-O',
            'description' => '15 - 20 days',
            'fast'      => false,
            'cost'      => '50.00',
            'status'    => true,
        ]);
        $sh03->countries()->attach($countriesIds);

        $sh04 = ShippingCompany::create([
            'name'      => 'Aramex Outside Speed shipping',
            'code'      => 'ARA-O-SPD',
            'description' => '5 - 10 days',
            'fast'      => true,
            'cost'      => '80.00',
            'status'    => true,
        ]);
        $sh04->countries()->attach($countriesIds);
    }
}
