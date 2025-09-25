@extends('layouts.app_admin')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card card-info card-outline mt-5">
            <div class="card-header fw-bold">
                Cài đặt web
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('configs.update_web') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên miền</label>
                        <input type="text" name="domain" class="form-control" value="{{ $configs['domain'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề trang chủ</label>
                        <input type="text" name="title" class="form-control" value="{{ $configs['title'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hotline liên hệ</label>
                        <input type="text" name="phone" class="form-control" value="{{ $configs['phone'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email liên hệ</label>
                        <input type="text" name="email" class="form-control" value="{{ $configs['email'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Zalo</label>
                        <input type="text" name="zalo" class="form-control" value="{{ $configs['zalo'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{ $configs['facebook'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Từ khóa tìm kiếm</label>
                        <input type="text" name="keywword" class="form-control" value="{{ $configs['keywword'] ?? '' }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả web (SEO)</label>
                            <textarea cols="30" name="description" class="form-control" rows="10">{{ $configs['description'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icon web</label>
                        <input type="file" name="icon" class="form-control" value="{{ $configs['icon'] ?? '' }}">
                        @if (!empty($configs['icon']))
                            <div class="mt-3">
                                <img width="40" src="/storage/{{ $configs['icon'] }}" alt="">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control" value="{{ $configs['logo'] ?? '' }}">
                        @if (!empty($configs['logo']))
                            <div class="mt-3">
                                <img width="40" src="/storage/{{ $configs['logo'] }}" alt="">
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu cài đặt web</button>
                </form>
            </div>
        </div>

        <div class="card card-success card-outline mt-5">
            <div class="card-header fw-bold">
                Quản lý cấu hình thanh toán
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('configs.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên ngân hàng</label>
                        <input type="text" name="bank_name" class="form-control"
                            value="{{ $configs['bank_name'] ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số tài khoản</label>
                        <input type="text" name="bank_acc" class="form-control" value="{{ $configs['bank_acc'] ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="bank_pass" class="form-control"
                            value="{{ $configs['bank_pass'] ?? '' }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu cấu hình</button>
                </form>
            </div>
        </div>


        <div class="card card-warning card-outline mt-5 mb-5">
            <div class="card-header fw-bold">
                Quản lý ghi chú
            </div>
            <div class="card-body">
                <form method="POST" id="noteForm" action="{{ route('configs.update_note') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Lưu ý 1:</label>

                        <textarea name="note_1" id="summernote">{{ $configs2['note_1'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lưu ý 2:</label>
                        <textarea name="note_2" id="summernote1">{{ $configs2['note_2'] ?? '' }}</textarea>
                    </div>

                    <button type="submit" id="saveBtn" class="btn btn-primary">Lưu ghi chú</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("saveBtn").addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn submit ngay
            if (confirm("Bạn có chắc chắn muốn lưu ghi chú này không?")) {
                document.getElementById("noteForm").submit();
            }
        });

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

        const edito1 = SUNEDITOR.create((document.getElementById('summernote1') || 'summernote1'), {
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
        edito1.onChange = async (contents, core) => {
            document.getElementById('summernote1').value = contents
        };
    </script>
@endsection
