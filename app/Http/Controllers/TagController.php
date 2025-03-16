<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;


class TagController extends Controller
{
    public function index()
    {
        $tags = auth()->user()?->tags() ?? [];

        if ($tags->count() > 0) {
            $tags = $tags->orderBy('id','desc')->paginate(5);
        }

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(StoreTagRequest $request)
    {

        Tag::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->to(route('tags.index'))->with('success', 'Tag created successfully!');
    }

    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);

        return view('tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        $tag->update($request->validated());

        return redirect()->to(route('tags.index'))->with('success', 'Tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return redirect()->to(route('tags.index'))->with('success', 'Tag deleted successfully!');
    }
}
