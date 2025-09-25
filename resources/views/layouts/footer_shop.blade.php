<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">Anything you want</div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; 2025&nbsp;
        <a href="/" class="text-decoration-none">buyproxy.vn</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>

    <!-- HTML -->
<div class="contact-icons">
  <a href="{{ $data_c1['zalo'] ?? '' }}" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo">
  </a>
  <a href="{{ $data_c1['facebook'] ?? '' }}" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/2048px-2021_Facebook_icon.svg.png" alt="Facebook">
  </a>
  <a href="tel:{{ $data_c1['phone'] ?? '' }}">
    <img src="https://static.vecteezy.com/system/resources/previews/036/269/966/non_2x/phone-call-icon-answer-accept-call-icon-with-green-button-contact-us-telephone-sign-yes-button-incoming-call-icon-vector.jpg" alt="Phone">
  </a>
</div>

<!-- CSS -->
<style>
.contact-icons {
  position: fixed;
  right: 20px;
  bottom: 100px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  z-index: 9999;
}

.contact-icons a img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  box-shadow: 0 4px 8px rgba(0,0,0,0.3);
  transition: transform 0.3s, box-shadow 0.3s;
}

.contact-icons a img:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 12px rgba(0,0,0,0.5);
}
</style>
