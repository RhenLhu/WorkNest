<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $search = $request->input('search');

        $tasks = $user->tasks()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('dashboard', compact('tasks', 'search'));
    }

    public function storeTask(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
            'due_date' => 'nullable|date',
        ]);

        $user->tasks()->create([
            'title' => $request->title,
            'category' => $request->category ?? 'General',
            'due_date' => $request->due_date,
            'completed' => false,
        ]);

        return back()->with('success', 'Task added successfully!');
    }

    public function toggleTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['completed' => !$task->completed]);

        return back();
    }

    public function destroyTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return back();
    }
}