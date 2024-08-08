<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
<link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="/css/combobox.css" rel="stylesheet">
@section('content-header')

@endsection
@section('body')
<div class="row">
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">จัดการผู้ใช้งาน</h5>
            <div class="card-body">
                <form  method="post"
                        action="/admin/user/save" enctype="multipart/form-data">
                        @csrf
                     <input value="{{$ListUser[0]->id}}"  type="hidden" name="userId">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="prename_TH">คำนำหน้าชื่อ</label>
                            <input type="text" class="form-control" id="prename_TH" name="prename_TH"
                             value="{{ $ListUser[0]->prename_TH}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="firstname_TH">ชื่อ</label>
                            <input type="text" class="form-control" id="firstname_TH" name="firstname_TH"
                            value="{{ $ListUser[0]->firstname_TH}}" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lastname_TH">นามสกุล</label>
                            <input type="text" class="form-control" name="lastname_TH" id="lastname_TH"
                            value="{{ $ListUser[0]->lastname_TH}}"
                            >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email">Email * </label>
                            <input type="email" class="form-control" name="email" id="email" 
                                         value="{{ $ListUser[0]->email}}"
                            required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dep_id">หน่วยงาน</label>
                            <select id="dep_id" class="form-control" name="dep_id">
                                @foreach ($ListDep as $rows)
                                    <option value="{{$rows->dep_id}}"
                                    <?php   
                                        if( $ListUser[0]->dep_id == $rows->dep_id) echo 'selected';
                                    ?>
                                    >{{$rows->dep_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_type"> ประเภทผู้ใช้งาน </label>
                            <select id="user_type" class="form-control" name="user_type">
                                  <option value="">----- เลือก ------ </option>
                                @foreach ($Listtype as $rows)                             
                                    <option value="{{$rows->admin_type_name}}"
                                    <?php   
                                        if( $ListUser[0]->user_type == $rows->admin_type_name) echo 'selected';
                                    ?>
                                    
                                    >{{$rows->admin_type_detail}}</option>
                                @endforeach
                            </select>
                        </div>
                     
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Line Token</label>
                            <input type="text" class="form-control" name="lineToken" id="lineToken"  value="{{ $ListUser[0]->lineToken}}" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3"> บันทึก </button>
                    <button type="submit" class="btn btn-secondary mt-3 mx-2"> ยกเลิก  </button>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
@section('corescript')
<script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/slccombobox.js"></script>
<script>

</script>
@endsection