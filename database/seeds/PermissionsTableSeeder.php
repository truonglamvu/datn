<?php

use Illuminate\Database\Seeder;
use App\Repository\Permission\PermissionModel;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createPost = new PermissionModel();
		$createPost->name         = 'create-post';
		$createPost->display_name = 'Create Posts';
		$createPost->description  = 'create new blog posts'; 
		$createPost->save();

		$editUser = new PermissionModel();
		$editUser->name         = 'edit-user';
		$editUser->display_name = 'Edit Users';
		$editUser->description  = 'edit existing users';
		$editUser->save();

		$deleteUser = new PermissionModel();
		$deleteUser->name         = 'delete-user';
		$deleteUser->display_name = 'Delete user';
		$deleteUser->description  = 'Can delete user';
		$deleteUser->save();

		$editDocument = new PermissionModel();
		$editDocument->name         = 'edit-document';
		$editDocument->display_name = 'Edit document';
		$editDocument->description  = 'Can edit document';
		$editDocument->save();

		$deleteDocument = new PermissionModel();
		$deleteDocument->name         = 'delete-document';
		$deleteDocument->display_name = 'Delete document';
		$deleteDocument->description  = 'Can delete document';
		$deleteDocument->save();

		$createPermission = new PermissionModel();
		$createPermission->name         = 'create-permission';
		$createPermission->display_name = 'Create new permission';
		$createPermission->description  = 'Can create new permission';
		$createPermission->save();

		$editPermission = new PermissionModel();
		$editPermission->name         = 'edit-permission';
		$editPermission->display_name = 'Edit a permission';
		$editPermission->description  = 'Can edit permission';
		$editPermission->save();

		$deletePermission = new PermissionModel();
		$deletePermission->name         = 'delete-permission';
		$deletePermission->display_name = 'Delete permission';
		$deletePermission->description  = 'Can delete permission';
		$deletePermission->save();

		$createRole = new PermissionModel();
		$createRole->name         = 'create-role';
		$createRole->display_name = 'Create new role';
		$createRole->description  = 'Can create new role';
		$createRole->save();

		$editRole = new PermissionModel();
		$editRole->name         = 'edit-role';
		$editRole->display_name = 'Edit a role';
		$editRole->description  = 'Can edit role';
		$editRole->save();

		$deleteRole = new PermissionModel();
		$deleteRole->name         = 'delete-role';
		$deleteRole->display_name = 'Delete a role';
		$deleteRole->description  = 'Can delete a role';
		$deleteRole->save();

		$activeRole = new PermissionModel();
		$activeRole->name         = 'active-role';
		$activeRole->display_name = 'Active a role';
		$activeRole->description  = 'Can active a role';
		$activeRole->save();

		$activeUser = new PermissionModel();
		$activeUser->name         = 'active-user';
		$activeUser->display_name = 'Active a user';
		$activeUser->description  = 'Can active a user';
		$activeUser->save();

		$showListRole = new PermissionModel();
		$showListRole->name         = 'show-list-role';
		$showListRole->display_name = 'show list role';
		$showListRole->description  = 'show list role';
		$showListRole->save();

		$viewUser = new PermissionModel();
		$viewUser->name         = 'view-user';
		$viewUser->display_name = 'View user';
		$viewUser->description  = 'Can view user page';
		$viewUser->save();

		$viewRole = new PermissionModel();
		$viewRole->name         = 'view-role';
		$viewRole->display_name = 'View role';
		$viewRole->description  = 'Can view role page';
		$viewRole->save();

		$viewDocs = new PermissionModel();
		$viewDocs->name         = 'view-docs';
		$viewDocs->display_name = 'View document';
		$viewDocs->description  = 'Can view document page';
		$viewDocs->save();

		$viewPermission = new PermissionModel();
		$viewPermission->name         = 'view-permission';
		$viewPermission->display_name = 'View permission';
		$viewPermission->description  = 'Can view permission page';
		$viewPermission->save();

		$viewMenu = new PermissionModel();
		$viewMenu->name         = 'view-menu';
		$viewMenu->display_name = 'View menu';
		$viewMenu->description  = 'Can view menu page';
		$viewMenu->save();

		$createMenu = new PermissionModel();
		$createMenu->name         = 'create-menu';
		$createMenu->display_name = 'Create new menu';
		$createMenu->description  = 'Can create new menu';
		$createMenu->save();

		$editMenu = new PermissionModel();
		$editMenu->name         = 'edit-menu';
		$editMenu->display_name = 'Edit menu';
		$editMenu->description  = 'Can edit menu';
		$editMenu->save();

		$deleteMenu = new PermissionModel();
		$deleteMenu->name         = 'delete-menu';
		$deleteMenu->display_name = 'Delete a menu';
		$deleteMenu->description  = 'Can delete a menu';
		$deleteMenu->save();

		$viewDetailDocument = new PermissionModel();
		$viewDetailDocument->name         = 'view-detail-document';
		$viewDetailDocument->display_name = 'View detail document';
		$viewDetailDocument->description  = 'Can view detail document';
		$viewDetailDocument->save();

		$activeDocument = new PermissionModel();
		$activeDocument->name         = 'active-document';
		$activeDocument->display_name = 'Active a document';
		$activeDocument->description  = 'Can active a document';
		$activeDocument->save();

		$createUser = new PermissionModel();
		$createUser->name         = 'create-user';
		$createUser->display_name = 'Create new user';
		$createUser->description  = 'Can create new user';
		$createUser->save();
    }
}
