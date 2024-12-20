<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Arr;
use Hash;
use DB;
use DataTables;
class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', 'admin')->latest()->paginate(20);

        return view('backend.users.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        // $user->create(array_merge($request->validated(), [
        //     'password' =>Hash::make($request->password)
        // ]));

        $request->validate([
            'name' => ['required','min: 3'],
            'email' => ['required','email',Rule::unique('users', 'email')],
            'phone' => ['required',Rule::unique('users', 'phone')],
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->email;
        $user->password = $request->password;
        $user->status = 1;
        $user->user_type ='admin';
        $user->phone = $request->phone;
        $user->save();
        $user->syncRoles($request->get('role'));
        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'name' => ['required','min: 3'],
            'email' => ['required','email',Rule::unique('users', 'email')->ignore($request->id)],
            'phone' => ['required',Rule::unique('users', 'phone')->ignore($request->id)],
        ]);

        $user = User::where('email', $request->email)->where('phone', $request->phone)->first();
        if($user == null){
            return abort('404');
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = $input['password'];
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->email;
        if($request->password != ''){
            $user->password = $request->password;
        }
        $user->status = ($request->status == 1) ? 1 : 0;
        $user->user_type ='admin';
        $user->phone = $request->phone;
        $user->save();


        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }
    public function users_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return (string)view('backend.users.datatable_users_roles', compact('user'));
                })->rawColumns(['roles'])
                ->addColumn('action', function ($user) {
                    return (string)view('backend.users.datatable_users_action', compact('user'));
                })->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}


/*

git clone https://github.com/codeanddeploy/laravel8-authentication-example.git

if your using my previous tutorial navigate your project folder and run composer update



install packages

composer require spatie/laravel-permission
composer require laravelcollective/html

then run php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

php artisan migrate

php artisan make:migration create_posts_table

php artisan migrate

models
php artisan make:model Post

middleware
- create custom middleware
php artisan make:middleware PermissionMiddleware

register middleware
-

routes

controllers

- php artisan make:controller UsersController
- php artisan make:controller PostsController
- php artisan make:controller RolesController
- php artisan make:controller PermissionsController

requests
- php artisan make:request StoreUserRequest
- php artisan make:request UpdateUserRequest

blade files

create command to lookup all routes
- php artisan make:command CreateRoutePermissionsCommand
- php artisan permission:create-permission-routes

seeder for default roles and create admin user
php artisan make:seeder CreateAdminUserSeeder
php artisan db:seed --class=CreateAdminUserSeeder



*/
