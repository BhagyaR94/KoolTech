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
            <h3 class="box-title"> New Invoice </h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form','url'=>'modifyinvoice','name'=>'myform'])!!}


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
        <!-- Bill Dislplay here -->

        <div class="row-fluid">
            <h3 class="text-green">Total Unsaved Invoice Values</h3>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Gross Amount: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($gross,2,'.',',')}}/-</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Total Discounts: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($total_dis,2,'.',',')}}/-</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Total Dis Per: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($total_disper,2,'.',',')}}%</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Net Amount: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($net,2,'.',',')}}/-</label>
                </div>
            </div>
        </div>

        <!-- End Of Bill Display -->

        <div class="row-fluid">
            <div class="form-inline">

                <div class="form-group">
                    <input type="hidden" id="qtycheck">
                    {!! Form::label ('invoiceno_lbl','Cash:',['class' =>'control-label col-md-2']) !!}
                    <div class="col-md-1">
                        {!!Form::radio('PayType', 'CS', false,['class'=>'radio','onchange'=>'paycs()','autofocus'])!!}
                    </div>

                    {!! Form::label ('invoiceno_lbl','Credit:',['class' =>'control-label col-md-2']) !!}
                    <div class="col-md-1">
                        {!!Form::radio('PayType', 'CR', false,['class'=>'radio','onchange'=>'paycr()'])!!}
                    </div>

                </div>

                

                <div class="form-group">
                    {!! Form::label ('product_lbl','Product:',['class' =>'control-label ']) !!}

                    {!! Form::text('products','',['class'=>'form-control', 'placeholder'=>'Search', 'onkeyup'=>"showHint(this.value)",'size'=>'5' ,'id'=>'products1']) !!}
                    <select class="form-control" id="sih" onchange="selectProduct(this.value)">

                    </select>


                    <script>

                        function selectProduct(code)
                        {
                            var code1 = code.split(" ");
                            document.getElementById('products1').value = code1[0];
                            document.getElementById('qtycheck').value = code1[4];
                            document.getElementById('sih').disabled = true;
                        }
                    </script>

                </div>

                <div class="form-group">
                    {!! Form::label ('qty_lbl','Qty:',['class' =>'control-label']) !!}

                    {!! Form::number ('qty','',['class'=>'form-control', 'placeholder'=>'Quantity','style'=>'width:5em;']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('bil_dis_lbl','Dis %:',['class' =>'control-label']) !!}

                    {!! Form::text ('dis_per','',['class'=>'form-control','placeholder'=>'Discount Percentage','style'=>'width:5em;']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('invoiceno_lbl','Invoice No.:',['class' =>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::number ('invoiceid','',['class'=>'form-control', 'placeholder'=>'Invoice No.','style'=>'width:7em;','id'=>'invoiceid','readonly']) !!}
                    </div>
                </div>

                <script>

                    function paycr()
                    {
                        var cr = "{!!$invoice_cr->Inv_No!!}";
                        var cr1 = parseInt(cr);
                        document.getElementById("invoiceid").value = cr1 + 1;
                        //document.getElementById('invoiceid').disabled = true;
                    }

                    function paycs()
                    {
                        var cs = "{!!$invoice_cs->Inv_No!!}";
                        var cs1 = parseInt(cs);
                        document.getElementById("invoiceid").value = cs1 + 1;
                        //document.getElementById('invoiceid').disabled = true;
                    }

                    function checkStock()
                    {
                        var stockval = document.forms["myform"]["sih"].value;
                        alert(stockval);
                    }
                </script>

            </div>

        </div>

        <hr>


        <div class="row-fluid">
            <div class="form-inline">

                <div class="form-group">
                    {!! Form::label ('last_invoiceno_lbl','Last Credit Invoice:',['class' =>'control-label col-md-6']) !!}
                    <div class="col-md-6">
                        <label class="control-label text-danger h4">CR{!!$invoice_cr->Inv_No!!}</label>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label ('last_bal_lbl','Last Cash Invoice',['class' =>'control-label col-md-6']) !!}
                    <div class="col-md-6">
                        <label class="control-label text-danger h4">CS{!!$invoice_cs->Inv_No!!}</label>
                    </div>
                </div>



            </div>
        </div>

        <hr>




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
                <th>Actions</th>
                </thead>
                <?php $count = 0 ?>
                {!! Form::open(['class'=>'form', 'url'=>'clearinvoice' , 'method'=>'post']) !!}

                @foreach($temp_inv as $temp_invs)
                <?php $count = $count + 1 ?>
                <tr>   
                <input type="hidden" name="temp_id" value="{{$temp_invs->temp_id}}" />
                <input type="hidden" name="product_id" value="{{$temp_invs->Product_ID}}" />
                <input type="hidden" name="qty" value="{{$temp_invs->Qty}}" />
                <td>{{$count}}</td>
                <td>{{$temp_invs->Product_ID}}</td>
                <td>{!!$temp_invs->Product_Desc!!}</td>
                <td>{{$temp_invs->Invoice_No}}</td>
                <td>{{$temp_invs->Qty}}</td>
                <td>{{$temp_invs->Price}}</td>
                <td>{{$temp_invs->Dis_Per}}</td>
                <td>{{$temp_invs->Dis_Val}}</td>
                <td>{{$temp_invs->Bill_Dis_Val}}</td>
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


<script type="text/javascript">
    function selecttosave(e1)
    {
        var inid = document.getElementById(e1);
        var val = inid.options[inid.selectedIndex].value;
        window.location = val;
    }
</script>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="panel panel-primary">
                <div class="panel-heading"><h4><center>Please Enter an Invoice Number to Proceed</center></h4></div>
                <div class="panel-body">

                    {!! Form::open(['class'=>'form','url'=>'saveinvoice'])!!}

                    <div class="form-horizontal">

                        <div class="form-group">

                            {!! Form::label ('invoiceno_lbl','Select Customer:',['class' =>'control-label col-md-4']) !!}

                            <div class="col-md-8">
                                <select  name="Customer_ID" class="form-control">
                                    <option disabled selected value>-- MUST SELECT A CUSTOMER FOR CREDIT INVOICES --</option>
                                    @foreach($customers as $customer)
                                    <option value={{$customer->Cus_Code}}>{{$customer->Cus_Code}} - {{$customer->Cus_Name}} - {{$customer->Cus_CreditLimit}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            {!! Form::label ('invoiceno_lbl','Please Select An Invoice:',['class' =>'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <select class="form-control" name="InvoiceNo" id="saves">
                                    @foreach($temp_inv as $temp_invs)
                                    <option value="{{$temp_invs->Invoice_No}}">Invoice No: {{$temp_invs->Invoice_No}}</option>
                                    @endforeach
                                </select>
                                <hr>
                            </div>

                        </div>
                        


                        <div class="row-fluid">
                            <div class="col-md-4">


                            </div>


                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span>  Save Invoice',array('class'=>'btn btn-lg btn-success','type'=>'submit')) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-erase"></span>  Clear Fields',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}
                    {!! Form::close() !!}

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

                    {!! Form::open(['class'=>'form','url'=>'printinvoice'])!!}

                    <div class="form-horizontal margin">

                        <div class="form-group">

                            {!! Form::label ('bil_dis_lbl','Invoice Number:',['class' =>'control-label']) !!}
                            <div class="col-md-10 pull-right">
                                {!! Form::text ('Print_ID','',['class'=>'form-control','placeholder'=>'Discount Percentage']) !!}
                            </div>


                        </div>

                    </div>

                </div>
                <div class="panel-footer">
                    {!! Form::button('<span class="glyphicon glyphicon-print"></span>  Print Invoice',array('class'=>'btn btn-lg btn-success','type'=>'submit')) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-erase"></span>  Clear Fields',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
</div>


<script>
    function showHint(str) {

        document.getElementById('sih').disabled = false;

        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById("sih").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getsih/" + str, true);
            xmlhttp.send();
        }
    }
</script>

@stop