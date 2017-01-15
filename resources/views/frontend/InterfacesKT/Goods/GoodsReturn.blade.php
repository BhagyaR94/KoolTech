@extends('backend.layouts.app')

@section('content')

<script>
    function addindexes(p1)
    {
        var index_table = [p1];
        return p1;
    }
</script>



<!-- New Invoice Starts Here-->

<div class="box box-primary">
    <div class="box-header with-border">

        <div class="col-md-2">
            <h3 class="box-title"> Goods Return </h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form','url'=>'returngood','name'=>'myform'])!!}


            <ul class="list-inline">

                <li>{!! Form::button('<span class="glyphicon glyphicon-plus-sign"> Add</span>',array('class'=>'btn btn-lg btn-default','type'=>'submit','name'=>'Add')) !!}</li>
                <li><a class="btn btn-success btn-lg" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-floppy-disk"> Save</span></a></li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit','name'=>'modify')) !!}</li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset','name'=>'reset')) !!}</li>
                <li><a class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-print"> Print</span></a></li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'submit','name'=>'delete')) !!}</li>


            </ul>
        </div>


        <div class="col-md-1">
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div>





    </div><!-- /.box-header -->
    <div class="box-body bg-gray-active">

        <div class="container-fluid form-inline  margin-bottom margin">

            <div class="form-group col-md-4">
                {!! Form::label ('bil_dis_lbl','Return No.:',['class' =>'control-label']) !!}

                {!! Form::text ('ReturnNo','',['class'=>'input-sm','placeholder'=>'Return No.','id'=>'GrNo','readonly']) !!}
            </div>


            <div class="form-group col-md-4">
                {!! Form::label ('bil_dis_lbl','Product Code:',['class' =>'control-label']) !!}

                {!! Form::text ('ProductCode','',['class'=>'input-sm','placeholder'=>'Product Code','autofocus','onkeyup'=>'getproduct(this.value)','onchange'=>"setNumbers()"]) !!}

                {!! Form::label ('','',['class' =>'control-label','id'=>'product']) !!}
            </div>     


            <div class="form-group col-md-4">
                {!! Form::label ('bil_dis_lbl','Qty:',['class' =>'control-label']) !!}

                {!! Form::text ('Qty','',['class'=>'input-sm','style'=>'width:6em;','placeholder'=>'Qty','onkeyup'=>'getReceipt(this.value)']) !!}
            </div>         

        </div>

        <div class="container-fluid form-inline">
            <div class="form-group col-md-4">
                {!! Form::label ('bil_dis_lbl','Dis Per:',['class' =>'control-label']) !!}

                {!! Form::text ('DisPer','',['class'=>'input-sm','placeholder'=>'Discount Percentage','id'=>'receiveNo']) !!}
            </div>


            <div class="form-group col-md-4">
                {!! Form::label ('bil_dis_lbl','Amount:',['class' =>'control-label']) !!}

                {!! Form::text ('Amnt','',['class'=>'input-sm','placeholder'=>'Amount','onkeyup'=>'getcustomer(this.value)','onchange'=>"setNumbers()"]) !!}


            </div>     


            <div class="form-group col-md-4">
                {!! Form::label ('bil_dis_lbl','Supplier Code:',['class' =>'control-label']) !!}

                {!! Form::text ('SupCode','',['class'=>'input-sm','placeholder'=>'Supplier Code','onkeyup'=>'getsupplier(this.value)']) !!}
                {!! Form::label ('','',['class' =>'control-label','id'=>'supplier']) !!}
            </div>      
        </div>

        <hr>


        {!! Form::close()!!}


        <div class="row-fluid scrollbox">

            <table class="table table-responsive table-striped">
                <thead>
                <th></th>
                <th>Receive No.</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Dis Per</th>

                <th>Amount</th>

                <th>Actions</th>
                </thead>

                <?php $count = 0 ?>
                {!! Form::open(['class'=>'form', 'url'=>'cleareturn' , 'method'=>'post']) !!}

                @foreach($received as $recs)
                <?php $count = $count + 1 ?>
                <tr>   
                <input type="hidden" name="temp_id" value="{{$recs->Gr_LineNo}}" />
                <input type="hidden" name="grno" value="{{$recs->Gr_No}}" />
                <td>{{$count}}</td>

                <td>{!!$recs->Gr_No!!}</td>
                <td>{{$recs->Gr_ProCode}}</td>
                <td>{{$recs->Gr_Qty}}</td>
                <td>{{$recs->Gr_DisPer}}</td>
                <td>{{$recs->Gr_Amount}}</td>
                <td><button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>
                </tr>
                @endforeach

                {!! Form::close() !!}


            </table>

        </div>
    </div><!-- /.box-body -->
</div>
<!--box box-success-->

<!-- New Invoice Ends Here-->




<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="panel panel-primary">
                <div class="panel-heading"><h4><center>Please Enter an Return Number to Proceed</center></h4></div>
                <div class="panel-body">
                    {!! Form::open(['class'=>'form', 'url'=>'savereturngoods' , 'method'=>'post']) !!}
                    <div class="form-inline ">
                        <div class="form-group">
                            {!! Form::label ('bil_dis_lbl','Receipt Numebr:',['class' =>'control-label']) !!}

                            {!! Form::text ('SaveNo','',['class'=>'input-sm','placeholder'=>'Receipt Number','onkeyup'=>'savereturn(this.value)','onchange'=>'savereturn(this.value)']) !!}
                            
                            {!! Form::label ('bil_dis_lbl','',['class' =>'control-label','id'=>'test1']) !!}
                            
                        </div> 
                    </div>
                    


                </div>
                <div class="panel-footer">

                    {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'Save')) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-erase"> Reset</span>',array('class'=>'btn btn-lg btn-info','type'=>'reset','name'=>'reset')) !!}

                </div>

                {!! Form::close()!!}
            </div>

        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="panel panel-primary">
                <div class="panel-heading"><h4><center>Please Enter an Invoice Number to Print</center></h4></div>
                <div class="panel-body">



                </div>
                <div class="panel-footer">


                </div>
            </div>

        </div>
    </div>
</div>


<script>
    function getproduct(str) {

        if (str.length == 0) {
            document.getElementById("product").innerHTML = "Please Enter the Product Code";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    //var code1 = this.responseText.split(",");
                    document.getElementById("product").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getproduct/" + str, true);
            xmlhttp.send();
        }
    }

    function getsupplier(str) {

        if (str.length == 0) {
            document.getElementById("supplier").innerHTML = "Please Enter the Supplier Code";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    //var code1 = this.responseText.split(",");
                    document.getElementById("supplier").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getsupplier/" + str, true);
            xmlhttp.send();
        }
    }
    
    function savereturn(str) {

        if (str.length == 0) {
            document.getElementById("test1").innerHTML = "Please Enter the Supplier Code";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    //var code1 = this.responseText.split(",");
                    document.getElementById("test1").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "savereturn/" + str, true);
            xmlhttp.send();
        }
    }


    function setNumbers()
    {
        var grd_no = "{!!$last_rec->Gr_No!!}";
        var grd_no1 = parseInt(grd_no) + 1;
        document.getElementById('GrNo').value = grd_no1;
    }

</script>


@stop