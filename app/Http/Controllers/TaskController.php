<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

use function auth;
use function dd;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = auth()->user()?->tasks ?? [];

        return view('index', compact('tasks'));
    }

    public function create(): View
    {

        $tags = auth()->user()?->tags ?? [];

        return view('tasks.create', compact('tags'));
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        $tags = auth()->user()?->tags ?? [];

        return view('tasks.edit', compact('task', 'tags'));
    }

    public function store(CreateTaskRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $task = Task::create(array_merge(
                $request->validated(),
                ['user_id' => auth()->id()]
            ));

            if ($request->has('tags')) {
                $task->tags()->attach($request->tags);
            }
            DB::commit();

            return redirect()->route('tasks.home')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Task creation failed: ' . $e->getMessage(), ['exception' => $e]);

            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        $task->tags()->sync($request->tags);

        return redirect()->to(route('tasks.home'))->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->to(route('tasks.home'))->with('success', 'Task deleted successfully!');
    }

    public function complete(Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->complete = !$task->complete;
        $task->save();

        return redirect()->to(route('tasks.home'));
    }
}
