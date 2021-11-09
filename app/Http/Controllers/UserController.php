<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Routing\ResponseFactory;

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


    /**
     * Login User via api resource and create API token 
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        // creating token for user 
        $token=$user->createToken($request->device_name)->plainTextToken;
        // adding new column token into user response 
        $user->token=$token;
        // returning user data 
        return $user;
    }


    /**
     * get all Users via api resource  
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        $UsersList=User::all();
        
        return $UsersList;
    }

     /**
     * get all particular User by id via api resource  
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getUserByID($id)
    {
        $UpdatedUser = User::where('id', $id)->get();
        return $UpdatedUser;
    }

    /**
     * get all Users via api resource  
     *
     * @return \Illuminate\Http\Response
     */

    public function editUser(Request $request, $id)
    {
        // Validation logic start from here 

        try {
            // Finding User from table to update user data 
            Validator::make($request->all(), [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($id),   
                ],
                'name' => 'required|max:255',
                'role' => 'required', 
            ])->validate();

            $User = User::find($id);
            
            if($User){
                //Preparing parameters going to update 
                $User->name = $request->name;
                $User->email = $request->email;
                $User->role = $request->role;
                // updating data 
                
                $User->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'User updated successfully',
                ], 204);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Opps! Something went wrong',
                ], 422);    
            }
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
        }catch(\BadMethodCallException $exception){

            return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 422);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request,$id)
    {
        //
        try {
            User::destroy($id);
            return response()->json(204);
        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(422);
        }
    }
}
