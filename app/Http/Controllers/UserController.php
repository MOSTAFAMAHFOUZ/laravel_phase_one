<?php

namespace App\Http\Controllers;

use App\Events\SendMailEvent;
use App\Mail\AddNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|min:4|max:150',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|max:20',
            'type'=>'required|in:admin,editor,super_admin',
            'image'=>'required|image|mimes:png,jpg,jpeg,gif,webp|max:11000',
        ]);
        $imageName = 'user'.time().'.'.$request->image->extension();  
        $request->image->move(User::USER_PATH, $imageName);
        $data['password'] = bcrypt($request->password);
        $data['image'] = $imageName;

        // User::create($data);
        $data['password'] = $request->password;
        event(new SendMailEvent($data));
        return back()->with("success","data added successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>'required|string|min:4|max:150',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable|string|min:6|max:20',
            'type'=>'required|in:admin,editor,super_admin',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:11000',
        ]);

        if($request->has('image')){
            // delete file if exist 
            $this->removeImage(User::USER_PATH.$user->image);
            $imageName = 'product'.time().'.'.$request->image->extension();  
            $request->image->move(User::USER_PATH, $imageName);
            $data['image'] = $imageName;

        }

        if($request->has('password') && $request->password != ''){
            $data['password'] = bcrypt($request->password);
        }else{
            $data['password'] = $user->password;
        }
        

        User::where('id',$user->id)->update($data);
        return back()->with("success","data updated successfully");
    }

    
    // remove file if exist 
    private function removeImage($imagePath){
        if(\File::exists(public_path($imagePath))){
            \File::delete(public_path($imagePath));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->removeImage(User::USER_PATH.$user->image);
        $user->destroy($user->id);
        return back()->with("success","data deleted successfully");
        
    }
}
