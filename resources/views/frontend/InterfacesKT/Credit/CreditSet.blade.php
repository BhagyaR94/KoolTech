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
            <h3 class="box-title"> Credit Settlement </h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form','url'=>'','name'=>'myform'])!!}


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

        
        <div class="row-fluid">
            <h3 class="text-green">Setteled Amount: </h3>
        </div>
        <hr>
        <div class="row-fluid">
            <div class="form-inline">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Settle No:',['class' =>'control-label']) !!}

                        {!! Form::text ('Settle No.','',['class'=>'form-control','placeholder'=>'Settle No.','id'=>'setNo']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Customer:',['class' =>'control-label']) !!}

                        {!! Form::text ('Customer','',['class'=>'form-control','style'=>'width:4em;','autofocus','onkeyup'=>'getcustomer(this.value)','onchange'=>"setNumbers()"]) !!}
                        
                        {!! Form::label ('bil_dis_lbl','',['class' =>'control-label','id'=>'customer_name']) !!}
                    </div>     
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Receipt No:',['class' =>'control-label']) !!}

                        {!! Form::text ('Print_ID','',['class'=>'form-control','placeholder'=>'Receipt No.','onkeyup'=>'getReceipt(this.value)']) !!}
                    </div>         
                </div>

            </div>
        </div>
        
         <div class="row-fluid">
            <div class="form-inline">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Receipt Amount:',['class' =>'control-label']) !!}

                        {!! Form::label ('bil_dis_lbl','',['class' =>'control-label','id'=>'rcp_amt']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Receipt Balance',['class' =>'control-label']) !!}

                        {!! Form::label ('bil_dis_lbl','',['class' =>'control-label','id'=>'rcp_bal']) !!}
                    </div>     
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Available Balance:',['class' =>'control-label']) !!}

                        {!! Form::label ('bil_dis_lbl','',['class' =>'control-label','id'=>'avb_bal']) !!}
                        
                    </div>         
                </div>

            </div>
        </div>
        

        
        {!! Form::close()!!}
    </div><!-- /.box-body -->
</div>
<!--box box-success-->

<!-- New Invoice Ends Here-->




<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="panel panel-primary">
                <div class="panel-heading"><h4><center>Please Enter an Invoice Number to Proceed</center></h4></div>
                <div class="panel-body">

                   

                </div>
                <div class="panel-footer">
                    

                </div>
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
    function getcustomer(str) {

        if (str.length == 0) {
            document.getElementById("customer_name").innerHTML = "Please Enter a Valid Customer Code";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById("customer_name").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getcusname/" + str, true);
            xmlhttp.send();
        }
    }
    
    function setNumbers()
    {
        var crd_no="{!!$last_Set->Crd_No!!}";
        var crd_no1=parseInt(crd_no)+1;
        document.getElementById('setNo').value=crd_no1;
        
    }
    
    function getReceipt(str)
    {
        if (str.length == 0) {
            document.getElementById("rcp_amt").innerHTML = "Please Enter a Valid Receipt Code";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    var code1 = this.responseText.split("-");
                    document.getElementById('rcp_amt').innerHTML=code1[0] ;
                    document.getElementById("rcp_bal").innerHTML =code1[1] ;
                    document.getElementById("avb_bal").innerHTML =code1[0];
                }
            };
            xmlhttp.open("GET", "getreceiptdata/" + str, true);
            xmlhttp.send();
    }
    }
    
</script>


@stop