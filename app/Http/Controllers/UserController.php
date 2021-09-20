<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UsersList=User::paginate(10);
        
        return view('User/user',['userlist'=>$UsersList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $UpdatedUser = User::where('id', $id)->get();
        return view('User/user-edit',['user_data'=>$UpdatedUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation logic start from here 

        Validator::make($request->all(), [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),   
            ],
            'name' => 'required|max:255',
            'role' => 'required', 
        ])->validate();
        try {
            // Finding User from table to update user data 
            $User = User::find($id);
            if($User){
                //Preparing parameters going to update 
                $User->name = $request->name;
                $User->email = $request->email;
                $User->role = $request->role;
                // updating data 
                
                $User->save();
                $request->session()->flash('success', 'User updated successfully!');

            }else{
                $request->session()->flash('error', 'Opps! Something went wrong');      
            }
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Something went wrong');  
        }
    
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        try {
            User::destroy($id);
            $request->session()->flash('success', 'User deleted successfully!');
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Unable to delete this user');  
        }

        return redirect()->route('user.index');
    }
}
