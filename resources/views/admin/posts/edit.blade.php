@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.post.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.posts.update", [$post->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="community_id">{{ trans('cruds.post.fields.community') }}</label>
                <select class="form-control select2 {{ $errors->has('community') ? 'is-invalid' : '' }}" name="community_id" id="community_id" required>
                    @foreach($communities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('community_id') ? old('community_id') : $post->community->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('community'))
                    <span class="text-danger">{{ $errors->first('community') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.community_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.post.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.post.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $post->url) }}">
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_file">{{ trans('cruds.post.fields.post_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('post_file') ? 'is-invalid' : '' }}" id="post_file-dropzone">
                </div>
                @if($errors->has('post_file'))
                    <span class="text-danger">{{ $errors->first('post_file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_text">{{ trans('cruds.post.fields.post_text') }}</label>
                <textarea class="form-control {{ $errors->has('post_text') ? 'is-invalid' : '' }}" name="post_text" id="post_text" required>{{ old('post_text', $post->post_text) }}</textarea>
                @if($errors->has('post_text'))
                    <span class="text-danger">{{ $errors->first('post_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="votes">{{ trans('cruds.post.fields.votes') }}</label>
                <input class="form-control {{ $errors->has('votes') ? 'is-invalid' : '' }}" type="number" name="votes" id="votes" value="{{ old('votes', $post->votes) }}" step="1">
                @if($errors->has('votes'))
                    <span class="text-danger">{{ $errors->first('votes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.votes_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.post.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $post->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.postFileDropzone = {
    url: '{{ route('admin.posts.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="post_file"]').remove()
      $('form').append('<input type="hidden" name="post_file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="post_file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($post) && $post->post_file)
      var file = {!! json_encode($post->post_file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="post_file" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection