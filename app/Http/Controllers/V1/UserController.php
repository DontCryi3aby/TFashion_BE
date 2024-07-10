<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\UsersFilter;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UsersFilter();
        $queryItems = $filter->transform($request);

        
        [$sort, $queryItems] = $filter->transform($request);
        // Filter
        $users = User::where($queryItems);

        // Sort
        if($sort['field']) {
            $users = $users->orderBy($sort['field'], $sort['type']);
        }
        
        return new UserCollection($users->paginate()->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->except("avatar"));
        if($request->avatar) {
            $path = $request->file('avatar')->store('avatars', "public");
            $$request()->user()->update(["avatar" => $path]);
        }
        
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->update($request->except("avatar"));

            if($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', "public");
                if($oldAvatar = $user->avatar){
                    Storage::disk('public')->delete($oldAvatar);
                }
                $user->update(["avatar" => $path]);
            }
            DB::commit();

            return new UserResource($user);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'status'=> 200,
            'message' => "User deleted successfully!"
        ]);
    }
}