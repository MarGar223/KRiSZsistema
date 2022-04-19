<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteFormController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('notes.createNote');
    }

    public function createNote(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $request->user()->notes()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('notes');
    }

    public function showNote(Note $note)
    {
        return view('notes.editNote', [
            'note' => $note
        ]);
    }

    public function editNote(Request $request, Note $note)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        $request->user()->notes()->where('id', $note->id)->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect()->route('notes');
    }

    public function deleteNote(Request $request, Note $note)
    {

        $request->user()->notes()->where('id', $note->id)->delete();

        return redirect()->route('notes');
    }

    public function editNoteFromDashboard(Request $request, Note $note)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        $request->user()->notes()->where('id', $note->id)->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return back();
    }

    public function deleteNoteFromDashboard(Request $request, Note $note)
    {

        $request->user()->notes()->where('id', $note->id)->delete();

        return back();
    }
}
