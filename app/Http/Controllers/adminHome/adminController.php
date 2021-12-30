<?php

namespace App\Http\Controllers\adminHome;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\File;
use App\Models\Mall;
use App\Models\User;
use Illuminate\Auth\Events\Validate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class adminController extends Controller
{

// DELETE FUNCTION
    function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('admin.home');
    }
// View  User Function and redirect on admin Panel
    function  adminHome()
    {

        $data = User::get();
        //  $user = User::find(6);
        // dd($user);
        // $role1 = Role::findByName('user');
        // $role1->givePermissionTo($user);
        // $permissions = Permission::get();
        // $data = User::get();
        // dd($data->get);
        // dd(User::with('roles')->get());
        // $user->
        // $role = Role::findByName('user');
        // $user->assignRole($role);
        // $user->assignRole($role);
        // $userRole = $user->roles;
        // dd($userRole);
        //  $userRole = auth()->user()->hasRole('admin');
        // dd("Role is assigned");
        // $data =User::get();
        // if($userRole == "user")
        // $userRole =  $user->getRoleNames();
        // dd($userRole);
        // {
        //  dd($userRole);
        // }
        // else
        // {
        //     dd("NoAdmin");
        // }
         return view('admin.adminHome', ['values' => $data]);
    }

    //  ADD USER FUNCTION
    function addUser(Request $request)
    {

        $input  = $request->all();
        //  VALIDATING CREDENTIAL
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'c_password' => 'required_with:password|same:password|min:6',
        ]);
        $user = new User;
        $user->email = $input['email'];
        $user->name = $input['name'];
        $user->password = $input['password'];
        if ($input['is_admin'] == null) {
            $input['is_admin'] = 0;
            $user->roles_id = $input['is_admin'];
        } else {
            $user->roles_id = $input['is_admin'];
        }
        $user->save();
        return redirect()->route('admin.home');
    }

    // EDIT USER
    function showUser($id)
    {
        $data = User::find($id); //SEARCHING DATA FOR USER
        return view('admin.editUser', ['values' => $data]);
    }
    function editUser(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles_id = $request->is_admin;
        $user->save();
        return redirect()->route('admin.home');
    }


    // MALLS
    public function showMalls()
    {
        $data =  DB::table('malls')->get();
        return view('admin.malls.mallHome', ['values' => $data]);
    }

    // ADD NEW MALLS
    public function addMalls()
    {
        return view('admin.malls.addMalls');
    }
    public function addMallData(Request $request)
    {
        // dd($request->file('photo')->getRealPath());

        // dd($request);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'whtssupphone' => 'required',
        ]);
        $mall = new Mall;
        $mall->name = $request->name;
        $mall->slug = $request->slug;
        $mall->address = $request->address;
        $mall->lat = $request->lat;
        $mall->Long1 = $request->long;
        $mall->phone = $request->phone;
        $mall->whatsAppPhone = $request->whtssupphone;
        $mall->isActive = $request->is_active;
        $mall->featureDescription = $request->featuredescription;
        $mall->serviceDescription = $request->servicedescription;
        // Malls image save or not Checking for size of images
        $file  = new File();

        if ($request->imageName == "Mobile") {

            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
            // Resizing Image
            $img = Image::make($image->getRealPath());
            $img->resize(300,300);
            $img->save(public_path('/mobileImages/' . $filename));
            // Getting Image details
            $mimi = $image->getMimeType();
            $size = $image->getSize();
            $path =public_path('/mobileImages/' . $filename);
            //  Saving image details
            $file->originalFilename = $filename;
            $file->mimeType = $mimi;
            $file->fileSize = $size;
            $file->fileName = $filename;
            $file->url = "NULL";
            $file->inUse = 0;
            $file->save();
        } elseif ($request->imageName == "Portrait") {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
            // Resizing image
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800);
            $img->save(public_path('/portraitImages/' . $filename));
            // Getting details of image
            $mimi = $image->getMimeType();
            $size = $image->getSize();
            $path =public_path('/mobileImages/' . $filename);
            // Saving data for
            $file->originalFilename = $filename;
            $file->mimeType = $mimi;
            $file->fileSize = $size;
            $file->fileName = $filename;
            $file->url = "NULL";
            $file->inUse = 0;
            $file->save();
        } elseif ($request->imageName == "Desktop") {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
             // Resizing image
            $img = Image::make($image->getRealPath());
            $img->resize(600, 300);
            $img->save(public_path('/desktopImages/' . $filename));
             // Getting details of image
            $mimi = $image->getMimeType();
            $size = $image->getSize();
            $path =public_path('/mobileImages/' . $filename);
            // Saving data for
            $file->originalFilename = $filename;
            $file->mimeType = $mimi;
            $file->fileSize = $size;
            $file->fileName = $filename;
            $file->url = "NULL";
            $file->inUse = 0;
            $file->save();
        }

        $mall->save();
        return redirect()->route('mallList');
        // ->with('savedMall','Mall saved successfully');
    }
    // GET MALL DETAILS
    public function getMall($id)
    {
        $data = Mall::find($id);
        return view('admin.malls.editMall',['values'=>$data]);
    }
    public function editMall(Request $request)
    {
        $mall = Mall::find($request->id);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'whtssupphone' => 'required',
        ]);

        $mall->name = $request->name;
        $mall->slug = $request->slug;
        $mall->address = $request->address;
        $mall->lat = $request->lat;
        $mall->Long1 = $request->long;
        $mall->phone = $request->phone;
        $mall->whatsAppPhone = $request->whtssupphone;
        $mall->isActive = $request->is_active;
        $mall->featureDescription = $request->featuredescription;
        $mall->serviceDescription = $request->servicedescription;
        // Malls image save or not Checking for size of images
        $file  = new File();

        if ($request->imageName == "Mobile") {

            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
            // Resizing Image
            $img = Image::make($image->getRealPath());
            $img->resize(300,300);
            $img->save(public_path('/mobileImages/' . $filename));
            // Getting Image details
            $mimi = $image->getMimeType();
            $size = $image->getSize();
            $path =public_path('/mobileImages/' . $filename);
            //  Saving image details
            $file->originalFilename = $filename;
            $file->mimeType = $mimi;
            $file->fileSize = $size;
            $file->fileName = $filename;
            $file->url = "NULL";
            $file->inUse = 0;
            $file->save();
        } elseif ($request->imageName == "Portrait") {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
            // Resizing image
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800);
            $img->save(public_path('/portraitImages/' . $filename));
            // Getting details of image
            $mimi = $image->getMimeType();
            $size = $image->getSize();
            $path =public_path('/mobileImages/' . $filename);
            // Saving data for
            $file->originalFilename = $filename;
            $file->mimeType = $mimi;
            $file->fileSize = $size;
            $file->fileName = $filename;
            $file->url = "NULL";
            $file->inUse = 0;
            $file->save();
        } elseif ($request->imageName == "Desktop") {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
             // Resizing image
            $img = Image::make($image->getRealPath());
            $img->resize(600, 300);
            $img->save(public_path('/desktopImages/' . $filename));
             // Getting details of image
            $mimi = $image->getMimeType();
            $size = $image->getSize();
            $path =public_path('/mobileImages/' . $filename);
            // Saving data for
            $file->originalFilename = $filename;
            $file->mimeType = $mimi;
            $file->fileSize = $size;
            $file->fileName = $filename;
            $file->url = "NULL";
            $file->inUse = 0;
            $file->save();
        }

        $mall->save();
        return redirect()->route('mallList');
    }

    public function deleteMall($id)
    {
        $mall = Mall::find($id);
        $mall->delete();
        return redirect()->route('mallList');
    }

    // BRANDS
    public function viewBrands()
    {
        $data = Brand::get();
        return view('admin.brands.brandsHome',['values'=>$data]);
    }
    public function showAddbrands()
    {
        return view('admin.brands.addBrands');
    }

}
