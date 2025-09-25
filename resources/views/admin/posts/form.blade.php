<div class="mb-3">
    <label>Tiêu đề</label>
    <input type="text" name="title" value="{{ old('title',$post->title ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Mô tả</label>
    <textarea name="description" class="form-control">{{ old('description',$post->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Ảnh</label>
    <input type="file" name="image" class="form-control">
    @if(!empty($post->image))
        <img src="{{ asset('storage/'.$post->image) }}" width="150" class="mt-2">
    @endif
</div>

<div class="mb-3">
    <label>Trạng thái</label>
    <select name="status" class="form-control">
        <option value="0" {{ old('status',$post->status ?? 0) == 0 ? 'selected' : '' }}>Ẩn</option>
        <option value="1" {{ old('status',$post->status ?? 0) == 1 ? 'selected' : '' }}>Hiện</option>
    </select>
</div>

<div class="mb-3">
    <label>Nội dung</label>
    <textarea name="content" rows="5" class="form-control" id="summernote" required>{{ old('content',$post->content ?? '') }}</textarea>
</div>


<script>
    const editor = SUNEDITOR.create((document.getElementById('summernote') || 'summernote'), {
            // lang: SUNEDITOR_LANG['ko'],
            width: '100%',
            height: '500px',
            buttonList: [
                ['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
                ['fontColor', 'hiliteColor', 'outdent', 'indent', 'align', 'horizontalRule', 'list', 'table'],
                ['link', 'image', 'video', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save']
            ],
        });
        editor.onChange = async (contents, core) => {
            document.getElementById('summernote').value = contents
        };
</script>
