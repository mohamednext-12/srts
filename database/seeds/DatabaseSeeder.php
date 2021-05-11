<?php

use App\HologramCategories;
use App\Institution;
use App\Municipality;
use App\Region;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $user=User::find(2);
//        $user->assignRole('admin');
//        $role = Role::create(['name' => 'admin']);
//        $role = Role::create(['name' => 'supervisor']);
//        $role = Role::create(['name' => 'user']);
        // $this->call(UserSeeder::class);
//        Region::create([
//          'code'=>2,
//            'name_arab'=>'سليانة',
//            'name_french'=>'Siliana'
//        ]);
//        Municipality::create([
//            'region_id'=>1,
//        'code'=>15,
//        'name_arab'=>'سيدي بورويس',
//        'name_french'=>'Sidi Bou Rouis'
//        ]);
//        Municipality::create([
//            'region_id'=>1,
//        'code'=>19,
//        'name_arab'=>'برقو',
//        'name_french'=>'Bargou'
//        ]);
//        Municipality::create([
//            'region_id'=>1,
//        'code'=>12,
//        'name_arab'=>'بوعرادة',
//        'name_french'=>'Bou Arada'
//        ]);
//         Municipality::create([
//             'region_id'=>1,
//        'code'=>20,
//        'name_arab'=>'العروسة',
//        'name_french'=>'El Aroussa'
//        ]);
//
//         Municipality::create([
//             'region_id'=>1,
//        'code'=>14,
//        'name_arab'=>'الكريب',
//        'name_french'=>'El Krib'
//        ]);
//         Municipality::create([
//             'region_id'=>1,
//        'code'=>13,
//        'name_arab'=>'ڨعفور',
//        'name_french'=>'Gaâfour'
//        ]);
//         Municipality::create([
//             'region_id'=>1,
//        'code'=>18,
//        'name_arab'=>'كسرى',
//        'name_french'=>'Kesra'
//        ]);
//         Municipality::create([
//             'region_id'=>1,
//        'code'=>16,
//        'name_arab'=>'مكثر',
//        'name_french'=>'Maktar'
//        ]);
//         Municipality::create([
//             'region_id'=>1,
//        'code'=>17,
//        'name_arab'=>'الروحية',
//        'name_french'=>'Rouhia'
//        ]);
//        Level::create([
//            'code'=>1,
//            'name_arab'=>'الابتدائي',
//            'name_french'=>'Primaire'
//        ]);
//        Level::create([
//            'code'=>2,
//            'name_arab'=>'الإعدادي',
//            'name_french'=>''
//        ]);
//        Level::create([
//            'code'=>3,
//            'name_arab'=>'الثانوي',
//            'name_french'=>'Secondaire'
//        ]);

//        Institution::create([
//            'municipality_id'=>1,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية سيدي بورويس',
//            'name_french'=>'Ecole Sidi Bou Rouis'
//        ]);
//        Institution::create([
//            'municipality_id'=>1,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية سيدي بورويس',
//            'name_french'=>'Collége Sidi Bou Rouis'
//        ]);
//        Institution::create([
//            'municipality_id'=>1,
//            'level_id'=>3,
//            'name_arab'=>'معهد سيدي بورويس',
//            'name_french'=>'Lycée Sidi Bou Rouis'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>2,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية برقو',
//            'name_french'=>'Ecole Bargou'
//        ]);
//        Institution::create([
//            'municipality_id'=>2,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية برقو',
//            'name_french'=>'Collége Bargou'
//        ]);
//        Institution::create([
//            'municipality_id'=>2,
//            'level_id'=>3,
//            'name_arab'=>'معهد برقو',
//            'name_french'=>'Lycée Bargou'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>3,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية بوعرادة',
//            'name_french'=>'Ecole Bou Arada'
//        ]);
//        Institution::create([
//            'municipality_id'=>3,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية بوعرادة',
//            'name_french'=>'Collége Bou Arada'
//        ]);
//        Institution::create([
//            'municipality_id'=>3,
//            'level_id'=>3,
//            'name_arab'=>'معهد بوعرادة',
//            'name_french'=>'Lycée Bou Arada'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>4,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية العروسة',
//            'name_french'=>'Ecole El Aroussa'
//        ]);
//        Institution::create([
//            'municipality_id'=>4,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية العروسة',
//            'name_french'=>'Collége El Aroussa'
//        ]);
//        Institution::create([
//            'municipality_id'=>4,
//            'level_id'=>3,
//            'name_arab'=>'معهد العروسة',
//            'name_french'=>'Lycée El Aroussa'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>5,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية الكريب',
//            'name_french'=>'Ecole El Krib'
//        ]);
//        Institution::create([
//            'municipality_id'=>5,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية الكريب',
//            'name_french'=>'Collége El Krib'
//        ]);
//        Institution::create([
//            'municipality_id'=>5,
//            'level_id'=>3,
//            'name_arab'=>'معهد الكريب',
//            'name_french'=>'Lycée El Krib'
//        ]);
//
////        Institution::create([
////            'municipality_id'=>6,
////            'level_id'=>1,
////            'name_arab'=>'المدرسة الابتدائية ڨعفور',
////            'name_french'=>'Ecole Gaâfour'
////        ]);
//        Institution::create([
//            'municipality_id'=>6,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية ڨعفور',
//            'name_french'=>'Collége Gaâfour'
//        ]);
//        Institution::create([
//            'municipality_id'=>6,
//            'level_id'=>3,
//            'name_arab'=>'معهد ڨعفور',
//            'name_french'=>'Lycée Gaâfour'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>7,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية كسرى',
//            'name_french'=>'Ecole Kesra'
//        ]);
//        Institution::create([
//            'municipality_id'=>7,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية كسرى',
//            'name_french'=>'Collége Kesra'
//        ]);
//        Institution::create([
//            'municipality_id'=>7,
//            'level_id'=>3,
//            'name_arab'=>'معهد كسرى',
//            'name_french'=>'Lycée Kesra'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>8,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية مكثر',
//            'name_french'=>'Ecole Maktar'
//        ]);
//        Institution::create([
//            'municipality_id'=>8,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية مكثر',
//            'name_french'=>'Collége Maktar'
//        ]);
//        Institution::create([
//            'municipality_id'=>8,
//            'level_id'=>3,
//            'name_arab'=>'معهد مكثر',
//            'name_french'=>'Lycée Maktar'
//        ]);
//
//        Institution::create([
//            'municipality_id'=>9,
//            'level_id'=>1,
//            'name_arab'=>'المدرسة الابتدائية الروحية',
//            'name_french'=>'Ecole Rouhia'
//        ]);
//        Institution::create([
//            'municipality_id'=>9,
//            'level_id'=>2,
//            'name_arab'=>'المدرسة الاعدادية الروحية',
//            'name_french'=>'Collége Rouhia'
//        ]);
//        Institution::create([
//            'municipality_id'=>9,
//            'level_id'=>3,
//            'name_arab'=>'معهد الروحية',
//            'name_french'=>'Lycée Rouhia'
//        ]);
        HologramCategories::create([
           'number'=>'1',
           'price'=>'15',
        ]);
        HologramCategories::create([
            'number'=>'2',
            'price'=>'19',
        ]);
        HologramCategories::create([
            'number'=>'3',
            'price'=>'26.5',
        ]);
        HologramCategories::create([
            'number'=>'4',
            'price'=>'30.5',
        ]);
        HologramCategories::create([
            'number'=>'5',
            'price'=>'33.5',
        ]);
        HologramCategories::create([
            'number'=>'6',
            'price'=>'42.6',
        ]);
        HologramCategories::create([
            'number'=>'7',
            'price'=>'53',
        ]);
        HologramCategories::create([
            'number'=>'8',
            'price'=>'73',
        ]);
    }
}
