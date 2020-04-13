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

            <form id="add_station" method="POST" action="{{ url('/update-seed-sampling') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                @foreach($records as $row)
                    <input type="hidden" name="id" value="{{ $row->id }}">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Request No. <span style="color:red;">*</span></label>
                                <input type="text" name="request_no" id="request_no"  value="{{ $row->request_no }}" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Lab No. <span style="color:red;">*</span></label>
                                <input type="text" name="lab_no" id="lab_no"  value="{{ $row->lab_no }}" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Crop <span style="color:red;">*</span></label>
                                <select name="crop" id="crop" class="form-control select2"  style="width: 100%;">
                                    <option value="{{$row->crop}}">{{$row->crop}}</option>
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
                                <option value="{{$row->variety}}">{{$row->variety}}</option>
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
                                <input type="text" style="text-transform: capitalize;" value="{{ $row->source }}" name="source" id="source" class="form-control" placeholder="Source">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Lot No. <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->lot_no }}" name="lot_no" id="lot_no" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Weight of Seed Lot <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->weight_of_seed_lot }}" name="weight_of_seed_lot" id="weight_of_seed_lot" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">No. of bags <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->no_of_bags }}" name="no_of_bags" id="no_of_bags" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date Harvested <span style="color:red;">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="{{ $row->date_harvested }}" name="date_harvested" id="datepicker">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kind of Container <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->container }}" name="container" id="container" required class="form-control" style="text-transform: capitalize;" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Application <span style="color:red;">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="{{ $row->date_of_application }}" name="date_of_application" id="datepicker">
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
                                <input type="text" value="{{ $row->moisture_content }}" name="moisture_content" id="moisture_content"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Physical Purity Test <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->physical_purity }}" name="physical_purity" id="physical_purity"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Germination Test <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->germination }}"name="germination" id="germination"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Varietal Purity Test <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->varietal_purity }}" name="varietal_purity" id="varietal_purity"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Seed Health <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->seed_health }}" name="seed_health" id="seed_health"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tetrazolium Test (TTC) <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->ttc }}"name="ttc" id="ttc"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Others (please specify) <span style="color:red;">*</span></label>
                                <input type="text" value="{{ $row->others }}"name="others" id="others"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4><b><i>Sampled by:</i></b></h4>
                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Firstname <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->fname }}" name="fname" id="fname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Middlename <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->mname }}" name="mname" id="mname"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Lastname <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->lname }}" name="lname" id="lname" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Extensionname <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->ename }}" name="ename" id="ename"  class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name&nbspof&nbspCompany/President/General&nbspManager <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->name_of_company }}" name="name_of_company" id="name_of_company" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Address <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->address }}" name="address" id="address" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Purpose <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->purpose }}" name="purpose" id="purpose" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Remarks <span style="color:red;">*</span></label>
                                    <input type="text" value="{{ $row->remarks }}" name="remarks" id="remarks" required class="form-control" style="text-transform: capitalize;" placeholder="ex. 895645">
                                </div>
                            </div>
                    </div>
                @endforeach
                    <hr>

                </div>
                <div class="box-footer">
                    <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                    <span  class="pull-right"><button type="submit" class="btn btn-success">Update changes</button></span>
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
