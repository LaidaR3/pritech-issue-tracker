<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        //search tags
        $query = Tag::query();



        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $tags = $query->latest()->get();

        return view('tags.index', compact('tags'));
    }

    public function store(StoreTagRequest $request)
    {
        Tag::create($request->validated());

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully.');
    }
}