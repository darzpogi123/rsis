@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ url('/admin-seed-sampling') }}">
            <button type="button" class="btn btn-default btn-sm">Go Back</button>
        </a>

        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Seed Sampling</li>
            <li class="active">Edit Record</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <form id="add_station" method="POST" action="{{ url('/update-record') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    @foreach($records as $row)
                    <input type="hidden" name="id" value="{{ $row->id }}">

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
                                    <input type="text" class="form-control pull-right" name="date_of_application" id="datepicker">
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
                    @endforeach
                    <hr>

                </div>
                <div class="box-footer">
                    <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                    <span  class="pull-right"><button type="submit" class="btn btn-primary">Save changes</button></span>
                </div>
                <!-- /.box-body -->
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
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

         /* datepicker initialization */
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy',
        }); /* datepicker initialization */
    });
</script>
@endsection
