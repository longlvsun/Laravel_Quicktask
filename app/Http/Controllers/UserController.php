<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withoutGlobalScope('active')
            ->with('notes')
            ->paginate(config('view.page_size'));

        return view('users.index', ['users' => $users]);
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
        $user = User::withoutGlobalScope('active')->find($id);
        if (!$user) return Redirect::route('home');

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::withoutGlobalScope('active')->find($id);
        if (!$user) return Redirect::route('home');

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::withoutGlobalScope('active')->find($id);
        if (!$user) return Redirect::route('home');

        $newUser = $request->all();

        if (!Hash::check($newUser['old_password'], $user->password)) {
            return Redirect::back()
                ->withErrors(trans('form.old_password_not_matched'));
        }

        if (!isset($newUser['password']) || $newUser['password'] == '') {
            $newUser['password'] = $user->password;
        } else {
            $newUser['password'] = Hash::make($newUser['password']);
        }

        try {
            $user->fill($newUser)->save();
        } catch(Exception $exp) {
            $exp = $exp->getMessage();
            if (preg_match('/users.users_email_unique/', $exp)) {
                $exp = trans('form.email_existed');
            } else if (preg_match('/users.users_username_unique/', $exp)) {
                $exp = trans('form.username_existed');
            }

            return Redirect::back()->withErrors($exp);
        }

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withoutGlobalScope('active')->find($id);
        if (!$user) return Redirect::route('home');

        DB::beginTransaction();
        try {
            $user->notes()->delete();
            $user->delete();
            DB::commit();
        } catch (Exception $exp) {
            DB::rollBack();
            $exp = $exp->getMessage();
            if (preg_match('/notes_owner_id_foreign/', $exp)) {
                $exp = trans(
                    'form.delete_failed_has_note',
                    ['note' => $user->notes->count()],
                );
            }

            return Redirect::back()->withErrors($exp);
        }

        return Redirect::route('users.index');
    }
}
