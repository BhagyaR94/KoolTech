<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span><!--input-group-btn-->
        </div><!--input-group-->
        {{ Form::close() }}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{{ route('frontend.user.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Invoices</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'invoices'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Add Invoics</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'cancelinvoice'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Cancel Invoices</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'invsummery'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Invoice Summery</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Customers & Debtors</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'newcustomer'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Customers</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'debtors'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Debtors</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-pause"></i>
                    <span>Quotation</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'newquotation'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Quotation</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-dollar"></i>
                    <span>Receipts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'newreceipt'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Receipt</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'vouchers'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Voucher</span>
                        </a>
                    </li>

                </ul>
            </li>



            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Goods</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'goodsreceived'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Goods Received</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'goodsreturn'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Goods Returned</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-paper-plane"></i>
                    <span>Records</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'genpo'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Purchase Orders</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'salesman'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Salesman Activity</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i>
                    <span>Products</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'products'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li class="{{ Active::pattern('admin/dashboard') }} treeview">
                <a href="#">
                    <i class="fa fa-building"></i>
                    <span>Stocks</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'products'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Stock1</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'products'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Stock2</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'products'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Stock3</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/dashboard') }}">
                        <a href="{{'products'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Stock4</span>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{{ route('admin.log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{{ route('admin.log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>
