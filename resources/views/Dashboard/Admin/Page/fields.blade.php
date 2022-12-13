<div class="card-body ">
    <div>
        <label for="title"> Title *</label>
        <input type="text" class="form-control" value="{{ old('title', $page->title) }}" name="title" id="title">
    </div>

    <div>
        <label for="name"> Content *</label>
        <textarea class="form-control" id="content" name="content">{{ old('content', $page->content) }}</textarea>

        <script type="text/javascript">
            CKEDITOR.replace('content', {
                filebrowserUploadMethod: 'form',
                filebrowserUploadUrl: "{{ route('admin-ckeditor-page-image.upload', ['_token' => csrf_token()]) }}",
                filebrowserBrowseUrl: '{{ asset('Asset/Uploads/Page/') }}',
            });

        </script>

    </div>
</div>
