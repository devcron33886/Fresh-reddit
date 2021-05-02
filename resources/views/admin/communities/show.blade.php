@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.community.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.communities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.community.fields.id') }}
                        </th>
                        <td>
                            {{ $community->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.community.fields.user') }}
                        </th>
                        <td>
                            @foreach($community->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.community.fields.name') }}
                        </th>
                        <td>
                            {{ $community->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.community.fields.description') }}
                        </th>
                        <td>
                            {{ $community->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.community.fields.slug') }}
                        </th>
                        <td>
                            {{ $community->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.community.fields.topics') }}
                        </th>
                        <td>
                            @foreach($community->topics as $key => $topics)
                                <span class="label label-info">{{ $topics->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.communities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection