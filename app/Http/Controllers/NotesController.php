
<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $notes = auth()->user()->notes()
            ->when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('notes.index', ['notes' => $notes, 'q' => $q]);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'color' => 'required|regex:/^#[0-9A-F]{6}$/i',
        ]);

        auth()->user()->notes()->create($validated);

        return redirect(route('notes.index'))->with('success', 'Заметка создана');
    }

    public function edit(Note $id)
    {
    }

    public function update(Request $request, Note $id)
    {
    }

    public function destroy(Note $id)
    {
    }

    public function togglePin(Note $id)
    {
    }
}
