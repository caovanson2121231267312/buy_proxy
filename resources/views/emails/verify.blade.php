@component('mail::message')
# Xác nhận Email

Xin chào **{{ $user->name }}**,  
Cảm ơn bạn đã đăng ký tài khoản tại **{{ config('app.name') }}**.

Vui lòng nhấn nút bên dưới để xác nhận email và kích hoạt tài khoản:

@component('mail::button', ['url' => $verifyUrl])
Xác nhận Email để đăng nhập
@endcomponent

Nếu bạn không yêu cầu đăng ký, vui lòng bỏ qua email này.

Trân trọng,<br>
**{{ config('app.name') }}**
@endcomponent
