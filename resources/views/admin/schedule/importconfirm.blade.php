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
      @if (count($getBookingList) > 0)
          <!--  @foreach ($getBookingList as $rows)
    @endforeach -->
      @endif
  @endsection
  @section('corescript')
      <script>
          $(function() {});
      </script>
  @endsection
