<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            array('name' => 'users.index','guard_name' => 'web'),
            array('name' => 'users.show','guard_name' => 'web'),
            array('name' => 'users.edit','guard_name' => 'web'),
            array('name' => 'users.create','guard_name' => 'web'),
            array('name' => 'users.store','guard_name' => 'web'),
            array('name' => 'users.update','guard_name' => 'web',),
            array('name' => 'users.destroy','guard_name' => 'web'),
           
            array('name' => 'roles.index','guard_name' => 'web'),
            array('name' => 'roles.edit','guard_name' => 'web'),
            array('name' => 'roles.create','guard_name' => 'web'),
            array('name' => 'roles.show','guard_name' => 'web'),
            array('name' => 'roles.store','guard_name' => 'web'),
            array('name' => 'roles.update','guard_name' => 'web'),
            array('name' => 'roles.destroy','guard_name' => 'web'),
            array('name' => 'permissions.index','guard_name' => 'web'),
            array('name' => 'permissions.edit','guard_name' => 'web'),
            array('name' => 'permissions.create','guard_name' => 'web'),
            array('name' => 'permissions.show','guard_name' => 'web'),
            array('name' => 'permissions.store','guard_name' => 'web'),
            array('name' => 'permissions.update','guard_name' => 'web'),
            array('name' => 'permissions.destroy','guard_name' => 'web'),
            array('name' => 'tutors.index','guard_name' => 'web'),
            array('name' => 'tutors.edit','guard_name' => 'web'),
            array('name' => 'tutors.create','guard_name' => 'web'),
            array('name' => 'tutors.show','guard_name' => 'web'),
            array('name' => 'tutors.store','guard_name' => 'web'),
            array('name' => 'tutors.update','guard_name' => 'web'),
            array('name' => 'tutors.destroy','guard_name' => 'web'),
            array('name' => 'tutors.status','guard_name' => 'web'),
            array('name' => 'tuitions.index','guard_name' => 'web'),
            array('name' => 'tuitions.edit','guard_name' => 'web'),
            array('name' => 'tuitions.create','guard_name' => 'web'),
            array('name' => 'tuitions.show','guard_name' => 'web'),
            array('name' => 'tuitions.store','guard_name' => 'web'),
            array('name' => 'tuitions.update','guard_name' => 'web'),
            array('name' => 'tuitions.destroy','guard_name' => 'web'),
            array('name' => 'tuitions.status','guard_name' => 'web'),
            array('name' => 'subject.index','guard_name' => 'web'),
            array('name' => 'subject.edit','guard_name' => 'web'),
            array('name' => 'subject.create','guard_name' => 'web'),
            array('name' => 'subject.show','guard_name' => 'web'),
            array('name' => 'subject.store','guard_name' => 'web'),
            array('name' => 'subject.update','guard_name' => 'web'),
            array('name' => 'subject.destroy','guard_name' => 'web'),
            array('name' => 'area.index','guard_name' => 'web'),
            array('name' => 'area.edit','guard_name' => 'web'),
            array('name' => 'area.create','guard_name' => 'web'),
            array('name' => 'area.show','guard_name' => 'web'),
            array('name' => 'area.store','guard_name' => 'web'),
            array('name' => 'area.update','guard_name' => 'web'),
            array('name' => 'area.destroy','guard_name' => 'web'),
            array('name' => 'admin_page.index','guard_name' => 'web'),
            array('name' => 'admin_page.edit','guard_name' => 'web'),
            array('name' => 'admin_page.create','guard_name' => 'web'),
            array('name' => 'admin_page.show','guard_name' => 'web'),
            array('name' => 'admin_page.store','guard_name' => 'web'),
            array('name' => 'admin_page.update','guard_name' => 'web'),
            array('name' => 'admin_page.destroy','guard_name' => 'web'),
            array('name' => 'tuition_book.index','guard_name' => 'web'),
            array('name' => 'tuition_book.edit','guard_name' => 'web'),
            array('name' => 'tuition_book.create','guard_name' => 'web'),
            array('name' => 'tuition_book.show','guard_name' => 'web'),
            array('name' => 'tuition_book.store','guard_name' => 'web'),
            array('name' => 'tuition_book.update','guard_name' => 'web'),
            array('name' => 'tuition_book.destroy','guard_name' => 'web'),
            array('name' => 'tuition_book.status','guard_name' => 'web'),
            array('name' => 'premium_package.index','guard_name' => 'web'),
            array('name' => 'premium_package.edit','guard_name' => 'web'),
            array('name' => 'premium_package.create','guard_name' => 'web'),
            array('name' => 'premium_package.show','guard_name' => 'web'),
            array('name' => 'premium_package.store','guard_name' => 'web'),
            array('name' => 'premium_package.update','guard_name' => 'web'),
            array('name' => 'premium_package.destroy','guard_name' => 'web'),
            array('name' => 'premium_package_items.index','guard_name' => 'web'),
            array('name' => 'premium_package_items.edit','guard_name' => 'web'),
            array('name' => 'premium_package_items.create','guard_name' => 'web'),
            array('name' => 'premium_package_items.show','guard_name' => 'web'),
            array('name' => 'premium_package_items.store','guard_name' => 'web'),
            array('name' => 'premium_package_items.update','guard_name' => 'web'),
            array('name' => 'premium_package_items.destroy','guard_name' => 'web'),
            array('name' => 'contact.index','guard_name' => 'web'),
            array('name' => 'contact.edit','guard_name' => 'web'),
            array('name' => 'contact.create','guard_name' => 'web'),
            array('name' => 'contact.show','guard_name' => 'web'),
            array('name' => 'contact.store','guard_name' => 'web'),
            array('name' => 'contact.update','guard_name' => 'web'),
            array('name' => 'contact.destroy','guard_name' => 'web'),
            array('name' => 'contact_delete','guard_name' => 'web'),
            array('name' => 'class.index','guard_name' => 'web'),
            array('name' => 'class.edit','guard_name' => 'web'),
            array('name' => 'class.create','guard_name' => 'web'),
            array('name' => 'class.show','guard_name' => 'web'),
            array('name' => 'class.store','guard_name' => 'web'),
            array('name' => 'class.update','guard_name' => 'web'),
            array('name' => 'class.destroy','guard_name' => 'web'),
            array('name' => 'weekly.index','guard_name' => 'web'),
            array('name' => 'weekly.edit','guard_name' => 'web'),
            array('name' => 'weekly.create','guard_name' => 'web'),
            array('name' => 'weekly.show','guard_name' => 'web'),
            array('name' => 'weekly.store','guard_name' => 'web'),
            array('name' => 'weekly.update','guard_name' => 'web'),
            array('name' => 'weekly.destroy','guard_name' => 'web'),
            array('name' => 'timely.index','guard_name' => 'web'),
            array('name' => 'timely.edit','guard_name' => 'web'),
            array('name' => 'timely.create','guard_name' => 'web'),
            array('name' => 'timely.show','guard_name' => 'web'),
            array('name' => 'timely.store','guard_name' => 'web'),
            array('name' => 'timely.update','guard_name' => 'web'),
            array('name' => 'timely.destroy','guard_name' => 'web'),
            array('name' => 'medium.index','guard_name' => 'web'),
            array('name' => 'medium.edit','guard_name' => 'web'),
            array('name' => 'medium.create','guard_name' => 'web'),
            array('name' => 'medium.show','guard_name' => 'web'),
            array('name' => 'medium.store','guard_name' => 'web'),
            array('name' => 'medium.update','guard_name' => 'web'),
            array('name' => 'medium.destroy','guard_name' => 'web'),
            array('name' => 'tuition_comment.index','guard_name' => 'web'),
            array('name' => 'tuition_comment.edit','guard_name' => 'web'),
            array('name' => 'tuition_comment.create','guard_name' => 'web'),
            array('name' => 'tuition_comment.show','guard_name' => 'web'),
            array('name' => 'tuition_comment.store','guard_name' => 'web'),
            array('name' => 'tuition_comment.update','guard_name' => 'web'),
            array('name' => 'tuition_comment.destroy','guard_name' => 'web'),
            array('name' => 'tuition_comment.status','guard_name' => 'web'),
            array('name' => 'tuition_comment.verified','guard_name' => 'web'),
            array('name' => 'subscriber_lists.index','guard_name' => 'web'),
            array('name' => 'subscriber_lists.edit','guard_name' => 'web'),
            array('name' => 'subscriber_lists.create','guard_name' => 'web'),
            array('name' => 'subscriber_lists.show','guard_name' => 'web'),
            array('name' => 'subscriber_lists.store','guard_name' => 'web'),
            array('name' => 'subscriber_lists.update','guard_name' => 'web'),
            array('name' => 'subscriber_lists.destroy','guard_name' => 'web'),
            array('name' => 'setting.index','guard_name' => 'web'),
            array('name' => 'setting.edit','guard_name' => 'web'),
            array('name' => 'setting.create','guard_name' => 'web'),
            array('name' => 'setting.show','guard_name' => 'web'),
            array('name' => 'setting.store','guard_name' => 'web'),
            array('name' => 'setting.update','guard_name' => 'web'),
            array('name' => 'setting.destroy','guard_name' => 'web'),
           
           
        );

        DB::table('permissions')->insert($permissions);
    }
}