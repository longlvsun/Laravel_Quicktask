<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNoteRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateNoteRequest $request)
    {
        $user = $request->user();
        $newNote = $request->only('title', 'content');
        $newNote['owner_id'] = $user->id;
        $newNote['created_at'] = now();
        $newNote['updated_at'] = now();

        try {
            $newId = DB::table('notes')->insertGetId($newNote);
        } catch (Exception $exp) {
            return Redirect::back()->withErrors($exp->getMessage());
        }

        return Redirect::route('notes.edit', ['note' => $newId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Redirect::route('notes.edit', ['note' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req, $id)
    {
        $user = $req->user();
        $note = DB::table('notes')->find($id);

        if (!$note || $note->owner_id != $user->id) {
            return Redirect::route('home');
        }

        return view('notes.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, $id)
    {
        $user = $request->user();
        $note = DB::table('notes')->find($id);

        if (!$note || $note->owner_id != $user->id) {
            return Redirect::route('home');
        }

        $newNote = $request->only('title', 'content');
        try {
            DB::table('notes')
                ->where('id', $id)
                ->update($newNote);
        } catch (Exception $exp) {
            return Redirect::back()->withErrors($exp->getMessage());
        }

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $note = DB::table('notes')->find($id);

        if (!$note || $note->owner_id != $user->id) {
            return Redirect::back();
        }

        try {
            DB::table('notes')
                ->where('id', $id)
                ->delete();
        } catch (Exception $exp) {
            return Redirect::back()->withErrors($exp->getMessage());
        }

        return Redirect::route('home');
    }
}
