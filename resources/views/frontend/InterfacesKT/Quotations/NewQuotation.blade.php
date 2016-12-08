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
        <h2>New Quotation</h2>
    </div>


    <!-- New Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-2">
                <h3 class="box-title"> New Invoice </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-9">

                {!! Form::open(['class'=>'form','url'=>'addquotation'])!!}


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
                <h3 class="text-danger">Total Unsaved Quotation Values</h3>
                
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

                        {!! Form::label ('invoiceno_lbl','Quotation No.:',['class' =>'control-label col-md-3']) !!}

                        {!! Form::number ('QuotationNo','',['class'=>'form-control col-md-7', 'placeholder'=>'Invoice Number']) !!}

                    </div>

                    <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Select Customer:',['class' =>'control-label col-md-4']) !!}

                        <div class="col-md-6">
                            <select  name="CustomerID" class="form-control">
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

                        {!! Form::number ('Quantity','',['class'=>'form-control', 'placeholder'=>'Quantity']) !!}

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
                <td>Qty</td>
                <td>Unit Price</td>
                <td>Dis %</td>
                <td>Discount</td>
                <td>Net Amount</td>
                <td>Drop Item</td>
                </thead>

            {!! Form::open(['class'=>'form', 'url'=>'clearqt' , 'method'=>'post']) !!}
        @foreach($temp_qt as $temp_invs)
                    <tr>   
                    <input type="hidden" name="product_id" value="{{$temp_invs->Product_ID}}" />
                    <td>{{$temp_invs->Product_ID}}</td>
                    <td>{!!$temp_invs->Product_Desc!!}</td>
                    <td>{{$temp_invs->Quotation_No}}</td>
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
        var inid=document.getElementById(e1);
        var val=inid.options[inid.selectedIndex].value;
        window.location=val;
    }
    </script>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
        <div class="panel panel-primary">
            <div class="panel-heading">Please Select an Invoice Number to Save</div>
            <div class="panel-body">
                
                
                
                <select class="form-control" id="saves">
                    @foreach($temp_qt as $temp_invs)
                                <option>{{$url = action('Frontend\Invoices\InvoiceController@save_records',['invoiceid' => $temp_invs->Quotation_No]) }}</option>
                    @endforeach
                </select>
                                
                    
               
            </div>
            <div class="panel-footer">
                 <button onclick="selecttosave('saves')" class="btn btn-lg btn-success">Select Invoice</button>
                 
            </div>
        </div>

    </div>
  </div>
</div>

    <!-- Cancel Invoice Ends Here-->

    @stop