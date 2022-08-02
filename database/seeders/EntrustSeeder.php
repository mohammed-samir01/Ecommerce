<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $adminRole = Role::create(['name'  => 'admin', 'display_name'  => 'Administration', 'description'   => 'Administrator', 'allowed_route' => 'admin']);
        $superVisorRole = Role::create(['name'  => 'supervisor', 'display_name'  => 'Supervisor', 'description'   => 'Supervisor', 'allowed_route' => 'admin']);
        $customerRole = Role::create(['name'    => 'customer', 'display_name'  => 'Customer', 'description'   => 'Customer', 'allowed_route' => null]);

        $admin = User::create([
            'first_name'        => 'Admin',
            'last_name'         => 'System',
            'username'          => 'admin',
            'email'             => 'admin@ecommerce.test',
            'email_verified_at' => now(),
            'mobile'            => '8465466456',
            'password'          => bcrypt('123123123'),
            'user_image'        =>'avatar.svg',
            'status'            => 1,
            'remember_token'    => Str::random(10)
        ]);

        $admin->attachRole(@$adminRole);

        $supervisor = User::create([
            'first_name'        => 'Supervisor',
            'last_name'         => 'System',
            'username'          => 'supervisor',
            'email'             => 'supervisor@ecommerce.test',
            'email_verified_at' => now(),
            'mobile'            => '4456468975',
            'password'          => bcrypt('123123123'),
            'user_image'        =>'avatar.svg',
            'status'            => 1,
            'remember_token'    => Str::random(10)
        ]);

        $supervisor->attachRole($superVisorRole);


        $customer = User::create([
            'first_name'        => 'Mohamed',
            'last_name'         => 'Samir',
            'username'          => 'hooksha',
            'email'             => 'hooksha@gmail.com',
            'email_verified_at' => now(),
            'mobile'            => '8465466454',
            'password'          => bcrypt('123123123'),
            'user_image'        =>'avatar.svg',
            'status'            => 1,
            'remember_token'    => Str::random(10)
        ]);

        $customer->attachRole($customerRole);


        for ($i = 1 ; $i <= 20 ; $i++){

            $random_customer = User::create([
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'username'          => $faker->userName,
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile'            => '8465'.$faker->numberBetween(1000000,9999999),
                'password'          => bcrypt('123123123'),
                'user_image'        =>'avatar.svg',
                'status'            => 1,
                'remember_token'    => Str::random(10)
            ]);

            $random_customer->attachRole($customerRole);

        }


        $manageMain = Permission::create([

            'name'              => 'main',
            'display_name'      => 'Main',
            'route'             => 'index',
            'module'            => 'index',
            'as'                => 'index',
            'icon'              => 'fas fa-home',
            'parent'            => '0',
            'parent_original'   => '0',
            'sidebar_link'      => '1',
            'appear'            => '1',
            'ordering'          => '1'

        ]);

        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        #######################            ProductCategories                   ##########################

        $manageProductCategories = Permission::create([

            'name'              => 'manage_product_categories',
            'display_name'      => 'categories',
            'route'             => 'product_categories',
            'module'            => 'product_categories',
            'as'                => 'product_categories.index',
            'icon'              => 'fas fa-file-archive',
            'parent'            => '0',
            'parent_original'   => '0',
            'sidebar_link'      => '1',
            'appear'            => '1',
            'ordering'          => '5'

        ]);

        $manageProductCategories->parent_show = $manageProductCategories->id;
        $manageProductCategories->save();


        $showProductCategories = Permission::create([

            'name'              => 'show_product_categories',
            'display_name'      => 'categories',
            'route'             => 'product_categories',
            'module'            => 'product_categories',
            'as'                => 'product_categories.index',
            'icon'              => 'fas fa-file-archive',
            'parent'            => $manageProductCategories->id,
            'parent_original'   => $manageProductCategories->id,
            'parent_show'       => $manageProductCategories->id,
            'sidebar_link'      => '1',
            'appear'            => '1',

        ]);

        $createProductCategories = Permission::create([

            'name'              => 'create_product_categories',
            'display_name'      => 'Create category',
            'route'             => 'product_categories',
            'module'            => 'product_categories',
            'as'                => 'product_categories.create',
            'icon'              => 'fas fa-file-archive',
            'parent'            => $manageProductCategories->id,
            'parent_original'   => $manageProductCategories->id,
            'parent_show'       => $manageProductCategories->id,
            'sidebar_link'      => '1',
            'appear'            => '0',

        ]);

        $displayProductCategories = Permission::create([

            'name'              => 'display_product_categories',
            'display_name'      => 'Show category',
            'route'             => 'product_categories',
            'module'            => 'product_categories',
            'as'                => null,
            'icon'              => 'fas fa-file-archive',
            'parent'            => $manageProductCategories->id,
            'parent_original'   => $manageProductCategories->id,
            'parent_show'       => $manageProductCategories->id,
            'sidebar_link'      => '1',
            'appear'            => '0',

        ]);

        $updateProductCategories = Permission::create([

            'name'              => 'update_product_categories',
            'display_name'      => 'Update category',
            'route'             => 'product_categories',
            'module'            => 'product_categories',
            'as'                => 'product_categories.update',
            'icon'              => null,
            'parent'            => $manageProductCategories->id,
            'parent_original'   => $manageProductCategories->id,
            'parent_show'       => $manageProductCategories->id,
            'sidebar_link'      => '1',
            'appear'            => '0',

        ]);


        $deleteProductCategories = Permission::create([

            'name'              => 'delete_product_categories',
            'display_name'      => 'Delete category',
            'route'             => 'product_categories',
            'module'            => 'product_categories',
            'as'                => 'product_categories.destroy',
            'icon'              => null,
            'parent'            => $manageProductCategories->id,
            'parent_original'   => $manageProductCategories->id,
            'parent_show'       => $manageProductCategories->id,
            'sidebar_link'      => '1',
            'appear'            => '0',

        ]);


        #######################            PRODUCTS TAGS                   ######################
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageTags->parent_show = $manageTags->id; $manageTags->save();
        $showTags = Permission::create(['name' => 'show_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTags = Permission::create(['name' => 'create_tags', 'display_name' => 'Create Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.create', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayTags = Permission::create(['name' => 'display_tags', 'display_name' => 'Show Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.show', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateTags = Permission::create(['name' => 'update_tags', 'display_name' => 'Update Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.edit', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteTags = Permission::create(['name' => 'delete_tags', 'display_name' => 'Delete Tag', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.destroy', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);


        #######################            PRODUCTS                   ##########################
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => 'Products', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageProducts->parent_show = $manageProducts->id; $manageProducts->save();
        $showProducts = Permission::create(['name' => 'show_products', 'display_name' => 'Products', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProducts = Permission::create(['name' => 'create_products', 'display_name' => 'Create Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProducts = Permission::create(['name' => 'display_products', 'display_name' => 'Show Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProducts = Permission::create(['name' => 'update_products', 'display_name' => 'Update Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProducts = Permission::create(['name' => 'delete_products', 'display_name' => 'Delete Product', 'route' => 'products', 'module' => 'products', 'as' => 'products.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);


        ########################           PRODUCT COUPONS               ########################
        $manageProductCoupons = Permission::create(['name' => 'manage_product_coupons', 'display_name' => 'Coupons', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percent', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageProductCoupons->parent_show = $manageProductCoupons->id; $manageProductCoupons->save();
        $showProductCoupons = Permission::create(['name' => 'show_product_coupons', 'display_name' => 'Coupons', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percent', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProductCoupons = Permission::create(['name' => 'create_product_coupons', 'display_name' => 'Create Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.create', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProductCoupons = Permission::create(['name' => 'display_product_coupons', 'display_name' => 'Show Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.show', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProductCoupons = Permission::create(['name' => 'update_product_coupons', 'display_name' => 'Update Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.edit', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProductCoupons = Permission::create(['name' => 'delete_product_coupons', 'display_name' => 'Delete Coupon', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.destroy', 'icon' => null, 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);

        ########################           PRODUCT REVIEWS                 #########################
         $manageProductReviews = Permission::create(['name' => 'manage_product_reviews', 'display_name' => 'Reviews', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
         $manageProductReviews->parent_show = $manageProductReviews->id; $manageProductReviews->save();
         $showProductReviews = Permission::create(['name' => 'show_product_reviews', 'display_name' => 'Reviews', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
         $createProductReviews = Permission::create(['name' => 'create_product_reviews', 'display_name' => 'Create Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.create', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
         $displayProductReviews = Permission::create(['name' => 'display_product_reviews', 'display_name' => 'Show Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.show', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
         $updateProductReviews = Permission::create(['name' => 'update_product_reviews', 'display_name' => 'Update Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.edit', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
         $deleteProductReviews = Permission::create(['name' => 'delete_product_reviews', 'display_name' => 'Delete Review', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.destroy', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);

        ########################              CUSTOMERS                    ############################
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name' => 'Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '30',]);
        $manageCustomers->parent_show = $manageCustomers->id; $manageCustomers->save();
        $showCustomers = Permission::create(['name' => 'show_customers', 'display_name' => 'Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCustomers = Permission::create(['name' => 'create_customers', 'display_name' => 'Create Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.create', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCustomers = Permission::create(['name' => 'display_customers', 'display_name' => 'Show Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.show', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateCustomers = Permission::create(['name' => 'update_customers', 'display_name' => 'Update Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.edit', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteCustomers = Permission::create(['name' => 'delete_customers', 'display_name' => 'Delete Customer', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.destroy', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);

        #########################              COUNTRIES                   ##################################
        $manageCountries = Permission::create(['name' => 'manage_countries', 'display_name' => 'Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45',]);
        $manageCountries->parent_show = $manageCountries->id; $manageCountries->save();
        $showCountries = Permission::create(['name' => 'show_countries', 'display_name' => 'Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCountries = Permission::create(['name' => 'create_countries', 'display_name' => 'Create Country', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.create', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCountries = Permission::create(['name' => 'display_countries', 'display_name' => 'Show Country', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.show', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateCountries = Permission::create(['name' => 'update_countries', 'display_name' => 'Update Country', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.edit', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteCountries = Permission::create(['name' => 'delete_countries', 'display_name' => 'Delete Country', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.destroy', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);

       ###########################                STATES                    #################################
        $manageStates = Permission::create(['name' => 'manage_states', 'display_name' => 'States', 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $manageStates->parent_show = $manageStates->id; $manageStates->save();
        $showStates = Permission::create(['name' => 'show_states', 'display_name' => 'States', 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createStates = Permission::create(['name' => 'create_states', 'display_name' => 'Create State', 'route' => 'states', 'module' => 'states', 'as' => 'states.create', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayStates = Permission::create(['name' => 'display_states', 'display_name' => 'Show State', 'route' => 'states', 'module' => 'states', 'as' => 'states.show', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateStates = Permission::create(['name' => 'update_states', 'display_name' => 'Update State', 'route' => 'states', 'module' => 'states', 'as' => 'states.edit', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteStates = Permission::create(['name' => 'delete_states', 'display_name' => 'Delete State', 'route' => 'states', 'module' => 'states', 'as' => 'states.destroy', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);

        ##########################                 CITIES                    ################################
        $manageCities = Permission::create(['name' => 'manage_cities', 'display_name' => 'Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageCities->parent_show = $manageCities->id; $manageCities->save();
        $showCities = Permission::create(['name' => 'show_cities', 'display_name' => 'Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCities = Permission::create(['name' => 'create_cities', 'display_name' => 'Create City', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.create', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCities = Permission::create(['name' => 'display_cities', 'display_name' => 'Show City', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.show', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateCities = Permission::create(['name' => 'update_cities', 'display_name' => 'Update City', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.edit', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteCities = Permission::create(['name' => 'delete_cities', 'display_name' => 'Delete City', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.destroy', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);

        ########################              SUPERVISORS                   ###############################
        $mangeSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => 'supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '1000',]);
        $mangeSupervisors->parent_show = $mangeSupervisors->id; $mangeSupervisors->save();
        $showsupervisors = Permission::create(['name' => 'show_supervisors', 'display_name' => 'supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user', 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createsupervisors = Permission::create(['name' => 'create_supervisors', 'display_name' => 'Create Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaysupervisors = Permission::create(['name' => 'display_supervisors', 'display_name' => 'Show Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updatesupervisors = Permission::create(['name' => 'update_supervisors', 'display_name' => 'Update Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deletesupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name' => 'Delete Customer', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $mangeSupervisors->id, 'parent_original' => $mangeSupervisors->id, 'parent_show' => $mangeSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);



    }
}
