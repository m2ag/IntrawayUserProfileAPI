<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\User\UserInterface as UserInterface;
use Illuminate\Support\Facades\Validator as Validator;

class UserController extends Controller {

    public function __construct(UserInterface $repo) {
        $this->repo = $repo;
    }

    /**
     * Display all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return response()->json($this->repo->getAll(), 200);
        } catch (\Exception $ex) {
            Log::critical("Unable to get users {$ex->getCode()}, {$ex->getLine()}, {$ex->getMessage()}");

            return response("Oops Something Went Wrong!", 500);
        }
    }

    /**
     * Validate request and store a newly user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {

            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required',
                'email' => 'required|email',
                'image' => 'required',
            ]);
            
            if ($validator->passes()) {
                if ($this->repo->store($request->all())) {
                    Log::info("The user was successfully created: {$request->input('name')}");

                    return response()->json(['response' => 'The user was successfully created.'], 200);
                } else {
                    Log::error("Could not store user: {$request->input('name')}");

                    return response()->json(['response' => 'Could not store user'], 400);
                }
            } else {
                $errors = $validator->errors()->all();
                return response()->json(['response' => 'Could not store user', 'errors' => $errors], 400);
            }
            
        } catch (\Exception $ex) {
            Log::critical("Could not store user {$ex->getCode()}, {$ex->getLine()}, {$ex->getMessage()}");

            return response("Oops Something Went Wrong!", 500);
        }
    }

    /**
     * Display the user by ID
     * @param int $id
     * @return Returns the user if it finds it, otherwise returns error 400
     */
    public function show($id) {
        try {
            if ($this->repo->find($id)) {
                return response()->json($this->repo->find($id), 200);
            } else {
                return response()->json(['response' => "User with id {$id} does not exist"], 400);
            }
        } catch (\Exception $ex) {
            Log::critical("Unable to get user {$ex->getCode()}, {$ex->getLine()}, {$ex->getMessage()}");

            return response("Oops Something Went Wrong!", 500);
        }
    }

    /**
     * Update a user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'image' => 'required',
            ]);
            
            if ($validator->passes()) {
                if ($this->repo->update($request->all(), $id)) {
                    Log::info("The user (ID: {$id}) was successfully modified.");

                    return response()->json(['response' => 'The user was successfully modified.'], 200);
                } else {
                    Log::error("Could not modified user with ID: {$id}");

                    return response()->json(['response' => "Could not modified user with ID: {$id}"], 400);
                }
            } else {
                $errors = $validator->errors()->all();
                return response()->json(['response' => 'Could not modified user', 'errors' => $errors], 400);
            }
            
        } catch (\Exception $ex) {
            Log::critical("Could not modified user {$ex->getCode()}, {$ex->getLine()}, {$ex->getMessage()}");

            return response("Oops Something Went Wrong!", 500);
        }
    }

    /**
     * Remove the specified user from the user table.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            if ($this->repo->delete($id)) {
                Log::info("The user (ID: {$id}) was successfully deleted");

                return response()->json(['response' => 'The user was successfully deleted.'], 200);
            } else {
                Log::error("Could not deleted user with ID: {$id}");

                return response()->json(['response' => "Could not deleted user with ID: {$id}"], 400);
            }
        } catch (\Exception $ex) {
            Log::critical("Could not deleted user {$ex->getCode()}, {$ex->getLine()}, {$ex->getMessage()}");

            return response("Oops Something Went Wrong!", 500);
        }
    }

}
