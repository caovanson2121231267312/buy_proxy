@extends('layouts.app_admin')

@section('content')
<div class="container mt-4 mb-4">
    <h2>Tạo Thông báo</h2>

    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Người nhận</label>
            <select name="users[]" class="form-control select2" multiple="multiple">
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" id="summernote" rows="5" class="form-control" required></textarea>
        </div>



        <div class="form-check mb-3">
            <input type="checkbox" name="send_email" value="1" class="form-check-input" id="send_email">
            <label for="send_email" class="form-check-label">Gửi email</label>
        </div>

        <button type="submit" class="btn btn-success">Tạo</button>
        <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>


<script>
    const editor = SUNEDITOR.create((document.getElementById('summernote') || 'summernote'), {
            // lang: SUNEDITOR_LANG['ko'],
            width: '100%',
            height: '300px',
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

@endsection

