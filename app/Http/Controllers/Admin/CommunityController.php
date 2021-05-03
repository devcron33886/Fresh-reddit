<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommunityRequest;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\Topic;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommunityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('community_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $communities = Community::with(['users', 'topics'])->get();

        return view('admin.communities.index', compact('communities'));
    }

    public function create()
    {
        abort_if(Gate::denies('community_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id');

        $topics = Topic::all()->pluck('name', 'id');

        return view('admin.communities.create', compact('users', 'topics'));
    }

    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->all());
        $community->users()->sync($request->input('users', []));
        $community->topics()->sync($request->input('topics', []));

        return redirect()->route('admin.communities.index');
    }

    public function edit(Community $community)
    {
        abort_if(Gate::denies('community_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id');

        $topics = Topic::all()->pluck('name', 'id');

        $community->load('users', 'topics');

        return view('admin.communities.edit', compact('users', 'topics', 'community'));
    }

    public function update(UpdateCommunityRequest $request, Community $community)
    {
        $community->update($request->all());
        $community->users()->sync($request->input('users', []));
        $community->topics()->sync($request->input('topics', []));

        return redirect()->route('admin.communities.index');
    }

    public function show(Community $community)
    {
        abort_if(Gate::denies('community_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $community->load('users', 'topics');

        return view('admin.communities.show', compact('community'));
    }

    public function destroy(Community $community)
    {
        abort_if(Gate::denies('community_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $community->delete();

        return back();
    }

    
}
