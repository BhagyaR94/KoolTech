@extends('backend.layouts.app')

@section('content')

    {!! Form::open(['class'=>'form-horizontal','url'=>'addnewcustomer'])!!}

    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-3">
                <h3 class="box-title"> Add New Customer </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-8">




                <ul class="list-inline">

                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'save')) !!}</li>
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





        </div>
        <div class="box box-body">
            
            <div class="col-md-6">
            <div class="form-group">
                {!! Form::label ('cno','Customer Code:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('CustomerCode','',['class'=>'form-control', 'placeholder'=>'Customer Code','onkeyup'=>'showHint(this.value)']) !!}
                    
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('cnm','Customer Name:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('CustomerName','',['class'=>'form-control', 'placeholder'=>'Customer Name','id'=>'Cus_Name']) !!}
                    
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('cnic','Customer NIC.:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('CustomerNIC','',['class'=>'form-control', 'placeholder'=>'941211119v','id'=>'Cus_NIC']) !!}
                </div>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="form-group">
                {!! Form::label ('ctel','Telephone:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('Telephone','',['class'=>'form-control', 'placeholder'=>'0771234567','id'=>'Cus_Telephone']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('mail','Email:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::email ('Email','',['class'=>'form-control', 'placeholder'=>'Email','id'=>'Cus_Email']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('cl','Credit Limit:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::number ('CreditLimit','',['class'=>'form-control', 'placeholder'=>'Credit Limit','id'=>'Cus_CreditLimit']) !!}
                </div>
            </div>
            </div>
            
<hr>
            <div class="form-group">
                {!! Form::label ('ad1','Customer Address1:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-8">
                    {!! Form::text ('Address1','',['class'=>'form-control', 'placeholder'=>'Address1','id'=>'Cus_Address1']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label ('ad2','Customer Address2:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-8">
                    {!! Form::text ('Address2','',['class'=>'form-control', 'placeholder'=>'Address2','id'=>'Cus_Address2']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label ('ad3','Customer Address3:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-8">
                    {!! Form::text ('Address3','',['class'=>'form-control', 'placeholder'=>'Address3','id'=>'Cus_Address3']) !!}
                </div>
            </div>

            

            <div class="form-group">
                {!! Form::label ('rems','Remarks:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-10">
                    {!! Form::text ('Remarks','',['class'=>'form-control', 'placeholder'=>'Remarks','id'=>'Cus_Remarks']) !!}
                </div>
            </div>
<hr>

<div class="row-fluid">
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Credit:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('Credit','1',null,['class' =>'form-group col-md-6','id'=>'Cus_Credit'])!!}
    </div>
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Active:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('Active','1',null,['class' =>'form-group col-md-6','id'=>'Cus_Active'])!!}
    </div>
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Over Sales:',['class' =>'control-label col-md-6']) !!}
        {!!Form::checkbox('Oversales','1',null,['class' =>'form-group col-md-6','id'=>'Cus_OverSales'])!!}
    </div>
</div>

<div class="row-fluid">
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Sales Amount:',['class' =>'control-label col-md-6']) !!}
        {!! Form::number ('SalesAmount','',['class' =>'form-control col-md-3']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Outstanding Amount:',['class' =>'control-label col-md-9']) !!}
        {!! Form::number ('OutstandingAmount','',['class' =>'form-control col-md-3']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Balance Amount:',['class' =>'control-label col-md-6']) !!}
        {!! Form::number ('BalanceAmount','',['class' =>'form-control col-md-3']) !!}
    </div>
</div>


        </div>
        <div class="box-footer"></div>
    </div>

    {!! Form::close() !!}
    
    
    
    
    <script>
    function showHint(str) {

        //document.getElementById('sih').disabled = false;

        if (str.length == 0) {
                    document.getElementById('Cus_Name').value=""; 
                    document.getElementById('Cus_NIC').value="";
                    document.getElementById('Cus_Telephone').value="";
                    document.getElementById('Cus_Email').value="";
                    document.getElementById('Cus_Address1').value="";
                    document.getElementById('Cus_Address2').value="";
                    document.getElementById('Cus_Address3').value="";
                    document.getElementById('Cus_Credit').value="";
                    document.getElementById('Cus_CreditLimit').value="";
                    document.getElementById('Cus_CreditLimit').value="";
                    document.getElementById('Cus_Discount').value="";
                    document.getElementById('Cus_Remarks').value="";
                    document.getElementById('Cus_Active').value="";
                    document.getElementById('Cus_OverSales').value="";
            return;
        } 
        
        else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    var code1 = this.responseText.split("-");
                    //document.getElementById("sih").innerHTML = this.responseText;
                    document.getElementById('Cus_Name').value=code1[1];
                    document.getElementById('Cus_NIC').value=code1[0];
                    document.getElementById('Cus_Telephone').value=code1[5];
                    document.getElementById('Cus_Email').value=code1[6];
                    document.getElementById('Cus_Address1').value=code1[2];
                    document.getElementById('Cus_Address2').value=code1[3];
                    document.getElementById('Cus_Address3').value=code1[4];
                    document.getElementById('Cus_Credit').value=code1[7];
                    document.getElementById('Cus_CreditLimit').value=code1[8];
                    document.getElementById('Cus_CreditLimit').value=code1[8];
                    document.getElementById('Cus_Discount').value=code1[9];
                    document.getElementById('Cus_Remarks').value=code1[10];
                    document.getElementById('Cus_Active').value=code1[11];
                    document.getElementById('Cus_OverSales').value=code1[12];
                    //document.getElementById('Cus_Name').value=code1[0];
                }
            };
            
            xmlhttp.open("GET", "getcustomer/" + str, true);
            xmlhttp.send();
        }
    }
</script>
    

    @stop
