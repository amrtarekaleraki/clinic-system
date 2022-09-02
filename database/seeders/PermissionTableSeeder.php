<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {


    $permissions = [

            'المرضي',
            'قائمة المرضي',
            'الامراض',
            'قائمه الامراض',
            'الاطباء',
            'قائمه الاطباء',
            'الزيارات',
            'قائمه الزيارات',
            'الفواتير',
            'قائمه الفواتير',
            'المصروفات',
            'قائمه المصروفات',
            'الارشيف',
            'ارشيف المرضي',
            'ارشيف الفواتير',
            'المستخدمين',
            'الاعدادت',


            'اضافة فاتورة',
            'حذف الفاتورة',
            'تصدير EXCEL',
            'تغير حالة الدفع',
            'تعديل الفاتورة',
            'ارشفة الفاتورة',
            'طباعةالفاتورة',


            'اضافة مريض',
            'تعديل مريض',
            'حذف مريض',

            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',


            'الاشعارات',

    ];



    foreach ($permissions as $permission) {

    Permission::create(['name' => $permission]);
    }


    }
    }
