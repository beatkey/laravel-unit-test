<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;

    class UsersController extends Controller
    {
        public function index(){
            return User::all();
        }

        public function get(User $user){
            return $user;
        }

        public function create(Request $request){
            $user = User::create($request->all());
            return response()->json($user, 201);
        }

        public function update(Request $request){
            $user = User::find($request->user);
            if ($user == null) {
                return abort(404);
            }
            $user->update($request->all());
            return response()->json($user);
        }

        public function delete(User $user){
            $user->delete();
            return response()->json(null, 204);
        }
    }
