@extends('layouts.app_admin')

@section('content')
<div class="container mt-4 mb-4">
    <h2>Danh sách Thông báo</h2>
    <a href="{{ route('notifications.create') }}" class="btn btn-primary mb-3">+ Tạo Thông báo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Gửi email</th>
                <th>Người nhận</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_v as $noti)
            <tr>
                <td>{{ $noti->id }}</td>
                <td>{{ $noti->title }}</td>
                <td>{{ $noti->send_email ? 'Có' : 'Không' }}</td>
                <td>
                    @if($noti->user_ids)
                        {{ implode(', ', $noti->user_ids) }}
                        {{-- {{ $noti->user_ids }} --}}
                    @else
                        Tất cả
                    @endif
                </td>
                <td>{{ $noti->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data_v->links() }}
</div>
@endsection
