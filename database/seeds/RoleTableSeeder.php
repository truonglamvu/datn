<?php

use Illuminate\Database\Seeder;
use App\Repository\Role\RoleModel;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new RoleModel();
		$owner->name         = 'owner';
		$owner->display_name = 'Project Owner'; // optional
		$owner->description  = 'User is the owner of a given project'; // optional
		$owner->save();

		$admin = new RoleModel();
		$admin->name         = 'admin';
		$admin->display_name = 'User Administrator'; // optional
		$admin->description  = 'User is allowed to manage and edit other users'; // optional
		$admin->save();

		$guest = new RoleModel();
		$guest->name         = 'Guest';
		$guest->display_name = 'View Document public'; // optional
		$guest->description  = 'Can view documents public'; // optional
		$guest->save();

		$intern = new RoleModel();
		$intern->name         = 'intern';
		$intern->display_name = 'Intern'; // optional
		$intern->description  = 'internship'; // optional
		$intern->save();

		$hms = new RoleModel();
		$hms->name         = 'hms';
		$hms->display_name = 'hms'; // optional
		$hms->description  = 'HMS'; // optional
		$hms->save();

		$pms = new RoleModel();
		$pms->name         = 'pms';
		$pms->display_name = 'pms'; // optional
		$pms->description  = 'PMS'; // optional
		$pms->save();

		$superAdmin = new RoleModel();
		$superAdmin->name         = 'super-admin';
		$superAdmin->display_name = 'Super admin'; // optional
		$superAdmin->description  = 'Super admin'; // optional
		$superAdmin->save();
		$superAdmin->permissions()->attach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25]);
    }
}
