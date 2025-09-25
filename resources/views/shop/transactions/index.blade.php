@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h4>Lịch sử nạp tiền</h4>
            {{-- <form method="GET" action="{{ route('transactions.index') }}" class="row mt-2">
                <div class="col-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm user..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-3">
                    <select name="type" class="form-control">
                        <option value="">-- Loại giao dịch --</option>
                        <option value="deposit" {{ request('type')=='deposit'?'selected':'' }}>Nạp</option>
                        <option value="withdraw" {{ request('type')=='withdraw'?'selected':'' }}>Rút</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </form> --}}
        </div>

        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Loại</th>
                        <th>Số tiền</th>
                        {{-- <th>Phương thức</th> --}}
                        <th>Trạng thái</th>
                        {{-- <th>Ghi chú</th> --}}
                        <th>Ngày</th>
                        {{-- <th width="100">Hành động</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->user->name ?? '-' }}</td>
                            <td>
                                @if($t->type=='deposit')
                                    <span class="badge bg-success">Nạp</span>
                                @else
                                    <span class="badge bg-danger">Rút</span>
                                @endif
                            </td>
                            <td>{{ number_format($t->amount,0,',','.') }} ₫</td>
                            {{-- <td>{{ $t->method ?? '-' }}</td> --}}
                            <td>
                                @if($t->status=='success')
                                    <span class="badge bg-success">Thành công</span>
                                @elseif($t->status=='failed')
                                    <span class="badge bg-danger">Thất bại</span>
                                @else
                                    <span class="badge bg-warning">Chờ xử lý</span>
                                @endif
                            </td>
                            {{-- <td>{{ $t->note }}</td> --}}
                            <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                            {{-- <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editTransaction{{ $t->id }}">Sửa</button>
                            </td> --}}
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="editTransaction{{ $t->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('transactions.update',$t->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cập nhật giao dịch #{{ $t->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Trạng thái</label>
                                                <select name="status" class="form-control">
                                                    <option value="pending" {{ $t->status=='pending'?'selected':'' }}>Chờ xử lý</option>
                                                    <option value="success" {{ $t->status=='success'?'selected':'' }}>Thành công</option>
                                                    <option value="failed" {{ $t->status=='failed'?'selected':'' }}>Thất bại</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Ghi chú</label>
                                                <textarea name="note" class="form-control">{{ $t->note }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Lưu</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
