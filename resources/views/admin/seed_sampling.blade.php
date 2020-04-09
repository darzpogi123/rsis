@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="#" data-toggle="modal" data-target="#modal-station">
            <button type="button" class="btn btn-success btn-sm">Add Seed Sampling</button>
        </a>

        <ol class="breadcrumb">
           
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Seed Sampling</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Seed Sampling</h3> <small>As of {{date('F d, Y h:i a')}}</small>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <table class="table table-bordered table-hover datatable" id="records_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sampled by</th>
                            <th>Lab No.</th>
                            <th>Crop</th>
                            <th>Variety</th>
                            <th>Lot No.</th>
                            <th>Date Harvested</th>
                            <th>Quantity</th>
                            <th>Physical Purity</th>
                            <th>Moisture</th>
                            <th>Germination</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- Add Record modal -->
        <div class="modal fade" id="modal-station" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                                Add new Sampling
                        </h4>
                    </div>
                    <form id="add_station" method="POST" action="{{ url('/save-record') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Request No. <span style="color:red;">*</span></label>
                                            <input type="text" name="request_no" id="request_no" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Crop <span style="color:red;">*</span></label>
                                            <select name="crop" id="crop" class="form-control select2"  style="width: 100%;">
                                                <option selected disabled>Select Crop</option>
                                                <option value="Rice">Rice</option>
                                                <option value="Corn">Corn</option>
                                                <option value="Beans">Beans</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Variety <span style="color:red;">*</span></label>
                                        <select name="variety" id="variety" class="form-control select2"  style="width: 100%;">
                                            <option selected disabled>Select Variety</option>
                                            <option value="Rice">Rice</option>
                                            <option value="Corn">Corn</option>
                                            <option value="Beans">Beans</option>
                                            <option value="Rice">Rice</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Source/Origin <span style="color:red;">*</span></label>
                                            <input type="text" style="text-transform: capitalize;" name="source" id="source" class="form-control" placeholder="Source">
                                        </div>
                                    </div>
                                
                            
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Lot No. <span style="color:red;">*</span></label>
                                            <input type="text" name="lot_no" id="lot_no" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Weight of Seed Lot <span style="color:red;">*</span></label>
                                            <input type="text" name="weight_of_seed_lot" id="weight_of_seed_lot" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">No. of bags <span style="color:red;">*</span></label>
                                            <input type="text" name="no_of_bags" id="no_of_bags" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Harvested <span style="color:red;">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" name="date_harvested" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                            
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kind of Container <span style="color:red;">*</span></label>
                                            <input type="text" name="container" id="container" required class="form-control" style="text-transform: capitalize;" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Application <span style="color:red;">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" name="date_of_applciation" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                              
                            </div>
                            <hr>
                            <h4><b><i>Analysis</i></b></h4>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Moisture Content <span style="color:red;">*</span></label>
                                            <input type="text" name="moisture_content" id="moisture_content" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Physical Purity Test <span style="color:red;">*</span></label>
                                            <input type="text" name="physical_purity" id="physical_purity" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Germination Test <span style="color:red;">*</span></label>
                                            <input type="text" name="germination" id="germination" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Varietal Purity Test <span style="color:red;">*</span></label>
                                            <input type="text" name="varietal_purity" id="varietal_purity" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Seed Health <span style="color:red;">*</span></label>
                                            <input type="text" name="seed_health" id="seed_health" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tetrazolium Test (TTC) <span style="color:red;">*</span></label>
                                            <input type="text" name="ttc" id="ttc" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Others (please specify) <span style="color:red;">*</span></label>
                                            <input type="text" name="others" id="others" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    
                            </div>
                            <hr>
                            <h4><b><i>Sampled by:</i></b></h4>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Firstname <span style="color:red;">*</span></label>
                                            <input type="text" name="fname" id="fname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Middlename <span style="color:red;">*</span></label>
                                            <input type="text" name="mname" id="mname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Lastname <span style="color:red;">*</span></label>
                                            <input type="text" name="lname" id="lname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Extensionname <span style="color:red;">*</span></label>
                                            <input type="text" name="ename" id="ename" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name&nbspof&nbspCompany/President/General&nbspManager <span style="color:red;">*</span></label>
                                            <input type="text" name="name_of_company" id="name_of_company" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Address <span style="color:red;">*</span></label>
                                            <input type="text" name="address" id="address" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Purpose <span style="color:red;">*</span></label>
                                            <input type="text" name="purpose" id="purpose" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Remarks <span style="color:red;">*</span></label>
                                            <input type="text" name="remarks" id="remarks" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Add Record modal -->

        <!-- Edit Record modal -->
        <div class="modal fade" id="edit-modal-station" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                                Edit Seed Sampling
                        </h4>
                    </div>
                    <form id="edit_station" method="POST" action="{{ url('/save-record') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Request No. <span style="color:red;">*</span></label>
                                            <input type="text" name="request_no" id="request_no" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Crop <span style="color:red;">*</span></label>
                                            <select name="crop" id="crop" class="form-control select2"  style="width: 100%;">
                                                <option selected disabled>Select Crop</option>
                                                <option value="Rice">Rice</option>
                                                <option value="Corn">Corn</option>
                                                <option value="Beans">Beans</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Variety <span style="color:red;">*</span></label>
                                        <select name="variety" id="variety" class="form-control select2"  style="width: 100%;">
                                            <option selected disabled>Select Variety</option>
                                            <option value="Rice">Rice</option>
                                            <option value="Corn">Corn</option>
                                            <option value="Beans">Beans</option>
                                            <option value="Rice">Rice</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Source/Origin <span style="color:red;">*</span></label>
                                            <input type="text" style="text-transform: capitalize;" name="source" id="source" class="form-control" placeholder="Source">
                                        </div>
                                    </div>
                                
                            
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Lot No. <span style="color:red;">*</span></label>
                                            <input type="text" name="lot_no" id="lot_no" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Weight of Seed Lot <span style="color:red;">*</span></label>
                                            <input type="text" name="weight_of_seed_lot" id="weight_of_seed_lot" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">No. of bags <span style="color:red;">*</span></label>
                                            <input type="text" name="no_of_bags" id="no_of_bags" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Harvested <span style="color:red;">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" name="date_harvested" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                            
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kind of Container <span style="color:red;">*</span></label>
                                            <input type="text" name="container" id="container" required class="form-control" style="text-transform: capitalize;" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Application <span style="color:red;">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" name="date_of_applciation" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                              
                            </div>
                            <hr>
                            <h4><b><i>Analysis</i></b></h4>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Moisture Content <span style="color:red;">*</span></label>
                                            <input type="text" name="moisture_content" id="moisture_content" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Physical Purity Test <span style="color:red;">*</span></label>
                                            <input type="text" name="physical_purity" id="physical_purity" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Germination Test <span style="color:red;">*</span></label>
                                            <input type="text" name="germination" id="germination" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Varietal Purity Test <span style="color:red;">*</span></label>
                                            <input type="text" name="varietal_purity" id="varietal_purity" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Seed Health <span style="color:red;">*</span></label>
                                            <input type="text" name="seed_health" id="seed_health" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tetrazolium Test (TTC) <span style="color:red;">*</span></label>
                                            <input type="text" name="ttc" id="ttc" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Others (please specify) <span style="color:red;">*</span></label>
                                            <input type="text" name="others" id="others" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    
                            </div>
                            <hr>
                            <h4><b><i>Sampled by:</i></b></h4>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Firstname <span style="color:red;">*</span></label>
                                            <input type="text" name="fname" id="fname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Middlename <span style="color:red;">*</span></label>
                                            <input type="text" name="mname" id="mname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Lastname <span style="color:red;">*</span></label>
                                            <input type="text" name="lname" id="lname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Extensionname <span style="color:red;">*</span></label>
                                            <input type="text" name="ename" id="ename" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name&nbspof&nbspCompany/President/General&nbspManager <span style="color:red;">*</span></label>
                                            <input type="text" name="name_of_company" id="name_of_company" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Address <span style="color:red;">*</span></label>
                                            <input type="text" name="address" id="address" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Purpose <span style="color:red;">*</span></label>
                                            <input type="text" name="purpose" id="purpose" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Remarks <span style="color:red;">*</span></label>
                                            <input type="text" name="remarks" id="remarks" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Edit Record modal -->

        <!-- View Record modal -->
        <div class="modal fade" id="view-record" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                                Add View Record
                        </h4>
                    </div>
                    <div class="modal-body" style="background-color: #f1f1f1db!important;">
                        <div class="row">
                            <div class="col-md-3">

                              <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile">
                                  <img class="profile-user-img img-responsive" id="prof_pic" src="" alt="User profile picture">

                                  <h5 class="profile-username text-center" id="profile-username"></h5>

                                  <p class="text-muted text-center" id="idnum"></p>

                                  <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                      <b>Age</b> <a class="pull-right" id="prof-age"></a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>Birthday</b> <a class="pull-right" id="prof-bday"></a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>Gender</b> <a class="pull-right" id="prof-gender"></a>
                                    </li>
                                  </ul>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                            </div>

                            <!-- /.col -->
                            <div class="col-md-9">
                              <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#info" data-toggle="tab" aria-expanded="false">Info</a></li>
                                  <li class=""><a href="#cp" data-toggle="tab" aria-expanded="false">Contact Person</a></li>
                                </ul>
                                <div class="tab-content">
                                  <div class="tab-pane active" id="info">

                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="cp">

                                  </div>
                                  <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                              </div>
                              <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.View Record modal -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
@if (session()->has('message'))
    @if (session()->get('message') == 'success')
        <script>
            toastr.success('Successfully Save.', 'Success!');
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){

        $("#profileImage").click(function(e) {
            $("#imageUpload").click();
        });

        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]) );
            }
        }

        $("#imageUpload").change(function(){
            fasterPreview( this );
        });

         /* datatable initialization */
        $('#records_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('/admin-get-records')}}",
            columns: [
                { data: 'unique_id_num', name: 'id' },
                { data: 'fullname', name: 'name' },
                { data: 'birthdate', name: 'age' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'gender', name: 'gender' },
                { data: 'createdby', name: 'gender' },


                { data: 'action', name: 'action', className: 'text-center' }
            ]
        }); /* datatable initialization */

         /* datepicker initialization */
        $('#datepicker').datepicker({
            autoclose: true,
        }); /* datepicker initialization */

         /* Delete Button */
        $('#records_tbl').on('click', '#btn-del', function(){
            $.ajax({
                url: "{{ url('/admin-del-record') }}",
                type: "POST",
                data: {'data': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(items) {
                    if(items.status != 500)
                    {
                        toastr.success('Successfully Deleted.', 'Success!');
                        setTimeout(function(){ window.location.reload() }, 3000);
                    } else {
                        toastr.error('Something went wrong.', 'Oops!');
                    }
                }
            });
        }); /* Delete Button */

         /* View Button */
        $('#records_tbl').on('click', '#btn-view', function(){
            console.log($(this).attr('data-id'));
            var url = "{{$base_url}}";
            if($(this).attr('data-id'))
            {
                $.ajax({
                    url: "{{ url('/admin-get-record') }}",
                    type: "POST",
                    data: {'data': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                    success: function(items) {
                        if(items){
                            var prof_pic = items.user[0].profile_pic;
                            var cp_name = items.user[0].cp_fname + " " + items.user[0].cp_mname + " " + items.user[0].cp_lname;

                            if(items.user[0].profile_pic != null || items.user[0].profile_pic != "")
                            {
                                $("#prof_pic").attr('src', url + '/' + prof_pic);
                            } else {
                                $("#prof_pic").attr('src',"{{ asset('public/dist/img/images.jpg') }}");
                            }

                            $("#idVal").val(items.user[0].id);

                            $("#profile-username").text(capitalized(items.user[0].fname + ' ' + items.user[0].mname + ' ' + items.user[0].lname));
                            $("#prof-age").text(getAge(items.user[0].birthdate));
                            $("#prof-bday").text(moment(items.user[0].birthdate).format('MMM DD, YYYY'));
                            $("#prof-gender").text(items.user[0].gender);
                            $("#idnum").text(items.user[0].unique_id_num);
                            $("#info").html('<form class="form-horizontal"> <div class="form-group"> <label for="" class="col-sm-3 control-label">Civil Status</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].cs +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Address</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].address +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Street</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].street +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Barangay</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].barangays +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Phone Number</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].phone_num +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Telephone Number</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].tel_num +'"> </div> </div> </form>'); $("#view-record").modal('show');
                            $("#cp").html('<form class="form-horizontal"> <div class="form-group"> <label for="" class="col-sm-3 control-label">Name</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ cp_name +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Relationship</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].relationship +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Address</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].cp_address +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Phone Number</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].cp_phone_num +'"> </div> </div> <div class="form-group"> <label for="" class="col-sm-3 control-label">Telephone Number</label> <div class="col-sm-9"> <input type="text" class="form-control" readonly="" value="'+ items.user[0].cp_tel_num +'"> </div> </div> </form>'); }
                    }
                });
            }
        }); /* View Button */

        /* get Age */
        function getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        /* To Capitalized string */
        function capitalized(txt)
        {
            var str = txt;
            str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            return str;
        }
    });
</script>
@endsection
