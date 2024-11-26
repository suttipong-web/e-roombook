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
      @if (count($strerror) > 0)
          <h3>เกิดข้อผิดพลาด มีตารางข้อมูลที่ไม่สามารถ ลงได้ เนื่องจากมีการขอใช้ห้องประชุมล่วงหน้าก่อนแล้ว </h3>
          <hr>
          @foreach ($strerror as $rows)
              <div class="text-danger p-3 mb-3"> - {{ $rows }} </div>
          @endforeach
      @endif

      <div class="mt-2 text-center">
          <a class="btn btn-primary" href="/admin/schedules" role="button">จัดการตารางเรียน</a>
          <a class="btn btn-outline-success" href="/booking/2/ห้องเรียน" role="button" target="_blank"> ดูตารางเรียน </a>
      </div>
  @endsection
  @section('corescript')
      <script>
          $(function() {});
      </script>
  @endsection
