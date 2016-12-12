@extends('backend.layouts.app')

@section('content')

    <script>
        function addindexes(p1)
        {
            var index_table=[p1];
            return p1;
        }
    </script>


    <div class="row-fluid">
        <h2>Invoices</h2>
    </div>


    <!-- New Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-2">
                <h3 class="box-title"> New Invoice </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-9">

                {!! Form::open(['class'=>'form','url'=>'modifyinvoice'])!!}


                <ul class="list-inline">

                    <li>{!! Form::button('<span class="glyphicon glyphicon-plus-sign"> Add</span>',array('class'=>'btn btn-lg btn-default','type'=>'submit','name'=>'Add')) !!}</li>
                    <li><a class="btn btn-success btn-lg" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-floppy-disk"> Save</span></a></li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit','name'=>'modify')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset','name'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-print"> Print</span>',array('class'=>'btn btn-lg btn-primary','type'=>'submit','name'=>'print')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'submit','name'=>'delete')) !!}</li>


                </ul>
            </div>


            <div class="col-md-1">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div>





        </div><!-- /.box-header -->
        <div class="box-body">
            <!-- Bill Dislplay here -->
            <div class="row-fluid">
                <h3 class="text-danger">Total Unsaved Invoice Values</h3>
                
                <div class="col-md-3">
                    <div class="form-group">

                        <label class="control-label h4">Gross Amount: </label>
                        <label class="control-label h3 text-light-blue" id="gross_amount">{{$gross}}/-</label>


                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                       <label class="control-label h4">Total Discounts: </label>
                        <label class="control-label h3 text-light-blue" id="gross_amount">{{$total_dis}}/-</label>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label h4">Total Dis Per: </label>
                        <label class="control-label h3 text-light-blue" id="gross_amount">{{$total_disper}}%</label>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label h4">Net Amount: </label>
                        <label class="control-label h3 text-light-blue" id="gross_amount">{{$net}}/-</label>

                    </div>
                </div>


            </div>
            
            
            <hr>
            <!-- End Of Bill Display -->
            

            <div class="row-fluid">
                <div class="form-inline">

                    <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Invoice No.:',['class' =>'control-label col-md-3']) !!}

                        {!! Form::number ('invoiceid',$invoice_detail->Inv_No,['class'=>'form-control col-md-7', 'placeholder'=>'Invoice Number']) !!}

                    </div>

                    <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Select Customer:',['class' =>'control-label col-md-4']) !!}

                        <div class="col-md-6">
                            <select  name="cid" class="form-control">
                                @foreach($customers as $customer)
                                    <option value={{$customer->Cus_Code}}>{{$customer->Cus_Code}} - {{$customer->Cus_Name}}</option>
                                @endforeach
                            </select>
                            
                            
                        </div>

                    </div>

                </div>
            </div>

            <hr>
            <div class="form-inline">

                <div class="form-group">
                    {!! Form::label ('last_invoiceno_lbl','Last Invoice No.:',['class' =>'control-label col-md-6']) !!}

                    <label class="control-label text-warning h4">{!!$invoice_detail->Inv_No!!}</label>

                </div>

                <div class="form-group">
                    {!! Form::label ('last_bal_lbl','Last Bal.:',['class' =>'control-label col-md-6']) !!}

                    <label class="control-label text-warning h4">{!!$invoice_detail->Inv_NetAmount!!}</label>

                </div>
            </div>
            <hr>

            <div class="form-inline">

                    <div class="form-group">
                        {!! Form::label ('product_lbl','Product:',['class' =>'control-label ']) !!}


                            <select  name="products" class="form-control">
                                @foreach($products as $product)
                                    <option value={{$product->Pro_Code}}>{{$product->Pro_Code}} - {{$product->Pro_Description}}</option>
                                @endforeach
                            </select>


                    </div>


                    <div class="form-group">
                        {!! Form::label ('qty_lbl','Qty:',['class' =>'control-label']) !!}

                        {!! Form::number ('qty','',['class'=>'form-control', 'placeholder'=>'Quantity']) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::label ('bil_dis_lbl','Dis %:',['class' =>'control-label']) !!}

                        {!! Form::text ('dis_per','',['class'=>'form-control','placeholder'=>'Discount Percentage']) !!}

                    </div>


            </div>

            <hr>



            {!! Form::close() !!}       

            <div class="row-fluid">

                <table class="table table-striped">
                <thead>
                <td>Product</td>
                <td>Description</td>
                <td>Invoice No.</td>
                <td>Customer</td>
                <td>Qty</td>
                <td>Unit Price</td>
                <td>Dis %</td>
                <td>Discount</td>
                <td>Net Amount</td>
                <td>Actions</td>
                </thead>

            {!! Form::open(['class'=>'form', 'url'=>'clearinvoice' , 'method'=>'post']) !!}
            
        @foreach($temp_inv as $temp_invs)
            
                    <tr>   
                    <input type="hidden" name="product_id" value="{{$temp_invs->Product_ID}}" />
                    
                    <td>{{$temp_invs->Product_ID}}</td>
                    <td>{!!$temp_invs->Product_Desc!!}</td>
                    <td>{{$temp_invs->Invoice_No}}</td>
                    <td>{{$temp_invs->Customer_ID}}</td>
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




    <!-- Cancel Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="col-md-3"><h3 class="box-title"> Cancel Invoice </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4></div>
            <div class="col-md-8">
                {!! Form::open(['class'=>'form'])!!}
                <ul class="list-inline">

                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-print"> Print</span>',array('class'=>'btn btn-lg btn-primary','type'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'reset')) !!}</li>




                </ul>
            </div>
            <div class="col-md-1">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div>


        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="row-fluid">

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Gross Amount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Item Discount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$.:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Dis. Percentage.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','%%%%:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Net Amount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$.:',['class' =>'control-label']) !!}

                    </div>
                </div>


            </div>

            <hr>


            <div class="form-inline">

                <div class="form-group">

                    {!! Form::label ('invoiceno','Invoice No.:',['class' =>'control-label col-md-3']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-7', 'placeholder'=>'Invoice Number']) !!}

                </div>

                <div class="form-group">

                    {!! Form::label ('invoiceid','Salesman ID:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-4', 'placeholder'=>'SID','size'=>'1']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('salesman_name','Salesman Name',['class' =>'control-label col-md-10 text-success']) !!}
                </div>

                <div class="form-group">

                    {!! Form::label ('invoiceid','Customer ID:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-4', 'placeholder'=>'CID','size'=>'3']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('customer_name','Customer Name',['class' =>'control-label text-success']) !!}
                </div>

            </div>
            <hr>



            <div class="form-inline">

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Cancellation:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Cancellation:',['class' =>'control-label col-md-6 text-warning']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Invoice No.:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Invoice No.:',['class' =>'control-label text-warning col-md-6']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Bal.:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Bal.:',['class' =>'control-label text-warning col-md-6']) !!}

                </div>
            </div>
            <hr>

            <div class="form-group">


                {!! Form::text ('invoiceid','',['class'=>'form-control', 'placeholder'=>'Reason for the Cancellation']) !!}

            </div>



            {!! Form::close() !!}

            <table class="table table-striped">
                <th>
                <td>Product</td>
                <td>Description</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Dis</td>
                <td>DisVal</td>
                <td>Amount</td>
                </th>
            </table>

        </div><!-- /.box-body -->
    </div>
    <!--box box-success-->
    
    <script type="text/javascript">
    function selecttosave(e1)
    {
        var inid=document.getElementById(e1);
        var val=inid.options[inid.selectedIndex].value;
        window.location=val;
    }
    </script>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
        <div class="panel panel-primary">
            <div class="panel-heading"><h4><center>Please Select an Invoice Number to Proceed</center></h4></div>
            <div class="panel-body">
                
                {!! Form::open(['class'=>'form','url'=>'saveinvoice'])!!}
                
                <div class="form-group">
                {!! Form::label ('invoiceno_lbl','Please Select An Invoice:',['class' =>'control-label col-md-3']) !!}
                <div class="col-md-9">
                    <select class="form-control" name="InvoiceNo" id="saves">
                    @foreach($temp_inv as $temp_invs)
                    <option value="{{$temp_invs->Invoice_No}}">Invoice No: {{$temp_invs->Invoice_No}} | Customer Code- {{$temp_invs->Customer_ID}}</option>
                    @endforeach
                    </select>
                    <hr>
                </div>
                
                </div>
                <script>
                function disablefunction()
                {
                    document.getElementById("bank").disabled=true;
                    
                    document.getElementById("chqno").disabled=true;
                }
                
                function enablefunction()
                {
                    document.getElementById("bank").disabled=false;
                    
                    document.getElementById("chqno").disabled=false;
                }
                </script>
                
                
                <div class="row-fluid">
                    <div class="col-md-4">
                    
                    <div class="form-inline"   style="border-radius:5px; border-style: groove">
                        <h4>Payment Type</h4>
                <div class="form-group">
                {!! Form::label ('invoiceno_lbl','Cash:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!!Form::radio('PayType', 'CS', false,['class'=>'radio','onclick'=>'disablefunction()'])!!}
                </div>
            </div>
                
                <div class="form-group">
                 {!! Form::label ('invoiceno_lbl','Cheque:',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-6">
                    {!!Form::radio('PayType', 'CH', false,['class'=>'radio','onclick'=>'enablefunction()'])!!}
                </div>
            </div>
                
            </div>
                </div>
                
                
            </div>
                
                <div class="col-md-8 form-horizontal">
                            
                            <div class="form-group-sm">
                                {!! Form::label ('ctel','Amount:',['class' =>'control-label col-md-3']) !!}
                                    <div class="col-md-9">
                                {!! Form::text ('Amount','',['class'=>'form-control', 'placeholder'=>'Cash Given']) !!}
                                    </div>
                            </div>
                    
                            <div class="form-group-sm">
                                {!! Form::label ('ctel','Cheque No.:',['class' =>'control-label col-md-3']) !!}
                                    <div class="col-md-9">
                                {!! Form::text ('ChequeNo','',['class'=>'form-control', 'placeholder'=>'Cash Given', 'id'=>'chqno']) !!}
                                    </div>
                            </div>
                    
                            <div class="form-group-sm">
                                {!! Form::label ('ctel','Bank:',['class' =>'control-label col-md-3']) !!}
                                    <div class="col-md-9">
                                {!! Form::text ('Bank','',['class'=>'form-control', 'placeholder'=>'Cash Given','id'=>'bank']) !!}
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
    
    
    <script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getajax/"+str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form> 
First name: <input type="text" onkeyup="showHint(this.value)">
</form>

<select>
    <option id="txtHint"></option>
</select>

    <!-- Cancel Invoice Ends Here-->

    @stop