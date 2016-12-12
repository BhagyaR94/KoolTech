@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-md-4 col-md-push-8">

                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <img class="media-object" src="{{ $logged_in_user->picture }}" alt="Profile picture">
                                    </div><!--media-left-->

                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            {{ $logged_in_user->name }}<br/>
                                            <small>
                                                {{ $logged_in_user->email }}<br/>
                                                Joined {{ $logged_in_user->created_at->format('F jS, Y') }}
                                            </small>
                                        </h4>

                                        {{ link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => 'btn btn-info btn-xs']) }}

                                        @permission('view-backend')
                                            {{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration'), [], ['class' => 'btn btn-danger btn-xs']) }}
                                        @endauth
                                    </div><!--media-body-->
                                </li><!--media-->
                            </ul><!--media-list-->

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Sidebar Item</h4>
                                </div><!--panel-heading-->

                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                                </div><!--panel-body-->
                            </div><!--panel-->

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Sidebar Item</h4>
                                </div><!--panel-heading-->

                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-4-->

                        <div class="col-md-8 col-md-pull-4">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Welcome to "KoolTech Electricals" Smart Inventory System</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Invoices <span class="glyphicon glyphicon-list pull-right"></span></h3>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="invoices" class="btn btn-block btn-success"><h4>Add New Invoice <span class="glyphicon glyphicon-list"></span></h4></a>
                                            <a href="invoices" class="btn btn-block btn-warning"><h4>Cancel Added Invoice <span class="glyphicon glyphicon-pause"></span></h4></a>
                                            <a href="invoices" class="btn btn-block btn-danger"><h4>Delete Added Invoice <span class="glyphicon glyphicon-trash"></span></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            
                                            <h3>Stocks <span class="glyphicon glyphicon-tower pull-right"></span></h3>
                                            
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="invoices" class="btn btn-block btn-primary"><h4>Stocks <span class="glyphicon glyphicon-tower"></span></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Products <i class="fa fa-product-hunt pull-right"></i></span></h3>
                                            
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="invoices" class="btn btn-block btn-primary"><h4>Products <i class="fa fa-product-hunt"></i></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Customers <i class="fa fa-users pull-right"></i></h3>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="newcustomer" class="btn btn-block btn-success"><h4>Add New Customer <i class="fa fa-users"></i></h4></a>
                                            <a href="updatecustomer" class="btn btn-block btn-primary"><h4>Update Customer <i class="fa fa-edit"></i></h4></a>
                                            <a href="newcustomer" class="btn btn-block btn-danger"><h4>Delete Customers <i class="fa fa-trash"></i></h4></a>
                                            
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                                
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           
                                            <h3>Sellers <i class="fa fa-users pull-right"></i></h3>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                           <a href="invoices" class="btn btn-block btn-primary"><h4>Sellers <i class="fa fa-product-hunt"></i></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                                
                                
                                
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Quotations <i class="fa fa-book pull-right"></i></h3>
                                           
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="newquotation" class="btn btn-block btn-primary"><h4>New Quotation <i class="fa fa-book"></i></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                                
                                
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Receipts <i class="fa fa-book pull-right"></i></h3>
                                           
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="newreceipt" class="btn btn-block btn-primary"><h4>New Receipt <i class="fa fa-book"></i></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                                
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Returned Cheques <i class="fa fa-dollar pull-right"></i></h3>
                                           
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <a href="returnedcheques" class="btn btn-block btn-primary"><h4>Report Returned Cheque <i class="fa fa-book"></i></h4></a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                            </div><!--row-->

                        </div><!--col-md-8-->

                    </div><!--row-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
    
    
@endsection