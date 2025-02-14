  <!-- import  function service -->
  @inject('getService', 'App\class\HelperService')
  @extends('admin.main-layout')
  @section('content-header')
  <style type="text/css">
      .displayTable {
          font-size: 13px
      }

      .allform {
          font-size: 14px;
      }
  </style>
  @endsection
  @section('body')

  <br />
  <div>
      @if (count($strerror) > 0)
      <h3>เกิดข้อผิดพลาด มีตารางข้อมูลที่ไม่สามารถ ลงได้ เนื่องจากมีการขอใช้ห้องประชุมล่วงหน้าก่อนแล้ว </h3>
      <hr>
      @foreach ($strerror as $rows)
      <div class="text-danger p-3 mb-3"> - {{ $rows }} </div>
      @endforeach
      @else
      <div class="alert alert-success text-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
          </svg> บันทึกข้อมูลรายการจองห้องของท่าน เรียบร้อยแล้ว
      </div>
      @endif

      <div class="mt-2 text-center">
          <a class="btn btn-primary" href="/admin/schedules" role="button">จัดการตารางเรียน</a>
          
          <a class="btn btn-outline-success " href="/booking/2/ห้องเรียน" role="button" target="_blank"> ดูตารางเรียน </a>
      </div>
  </div>
  @endsection
  @section('corescript')
  <script>
      $(function() {});
  </script>
  @endsection