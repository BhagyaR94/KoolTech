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
            <h3 class="box-title"> Cancel Invoice </h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form', 'url'=>'cancelinv' , 'method'=>'post']) !!}


            <ul class="list-inline">

                <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'Add')) !!}</li> 
                <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'button','name'=>'modify')) !!}</li>
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
        <!-- Bill Dislplay here -->

        <div class="row-fluid">

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Gross Amount: </label>
                    <label class="control-label h4 text-green" id="gross_amount">/-</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Total Discounts: </label>
                    <label class="control-label h4 text-green" id="total_disc">/-</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Total Dis Per: </label>
                    <label class="control-label h4 text-green" id="disper">%</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Net Amount: </label>
                    <label class="control-label h4 text-green" id="net_amount">/-</label>
                </div>
            </div>
        </div>

        <!-- End Of Bill Display -->
        


        <div>
            <div class="form-group">
           
            {!! Form::label ('invoiceno_lbl','Cash:',['class' =>'control-label col-md-1']) !!}
            <div class="col-md-1">
                {!!Form::checkbox('PayType', 'C', false,['class'=>'radio','autofocus','id'=>'PayType'])!!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label ('qty_lbl','Inv_No:',['class' =>'control-label col-md-1']) !!}
            <div class="col-md-2">
                {!! Form::text ('Inv_No','',['class'=>'form-control input-sm', 'placeholder'=>'Invoice_No','onkeyup'=>'getinvoice(document.getElementById("PayType").checked,this.value)']) !!}
            </div>

            {!! Form::label ('qty_lbl','Reason:',['class' =>'control-label col-md-1']) !!}
            <div class="col-md-6">
                {!! Form::text ('Reason','',['class'=>'form-control input-sm', 'placeholder'=>'Reason']) !!}
            </div>
        </div>
        </div>

        {!! Form::close() !!}   
        
        
       

        <div class="row-fluid">

            <table class="table table-striped">


                <thead>
                <th></th>
                <th>Product</th>
                <th>Description</th>
                <th>Invoice No.</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Dis %</th>
                <th>Discount</th>
                <th>Net Amount</th>
                
                </thead>



                <?php $count = 0 ?>
                {!! Form::open(['class'=>'form', 'url'=>'clearinvoice' , 'method'=>'post']) !!}


                <?php $count = $count + 1 ?>
                <tr>   

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>

                {!! Form::close() !!}

            </table>

        </div>

    </div><!-- /.box-body -->
</div>
<!--box box-success-->

<!-- New Invoice Ends Here-->
<label id="test1"></label>

<script type="text/javascript">
    function selecttosave(e1)
    {
        var inid = document.getElementById(e1);
        var val = inid.options[inid.selectedIndex].value;
        window.location = val;
    }
</script>


<script>
    function getinvoice(str,str2) {


        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    var results = this.responseText.split(",");
                    document.getElementById("gross_amount").innerHTML=results[2];
                    document.getElementById("total_disc").innerHTML=results[3];
                    //document.getElementById("disper").innerHTML=results[2];
                    document.getElementById("net_amount").innerHTML=results[4];
                    //document.getElementById("test1").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getinvoice/" +str+"/"+str2, true);
            xmlhttp.send();
        }
    }
</script>

@stop