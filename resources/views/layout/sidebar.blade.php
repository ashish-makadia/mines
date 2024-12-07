@php

$currentRoute = Route::currentRouteName();

$masterMenuRoutes = ['quc-managment', 'credit-days','product','department','designation'];
$isMasterActive = in_array($currentRoute, $masterMenuRoutes);

$mineMenuRoutes = ['mine','add-mine','edit-mine','machinery-assets','machinery-assets-add','machinery-assets-edit'];
$isMineActive = in_array($currentRoute, $mineMenuRoutes);

$assetMenuRoutes = [ 'assets-category', 'assign-asset','assets-assign'];
$isAssetActive = in_array($currentRoute, $assetMenuRoutes);

$dailyRegisterMenuRoutes = [ 'dispacth-register','meter-reading','diesel-stock'];
$isDailyRegisterActive = in_array($currentRoute, $dailyRegisterMenuRoutes);

$cutomerMenuRoutes = ['customer-managment'];
$isCutomerActive = in_array($currentRoute, $cutomerMenuRoutes);

$vendorMenuRoutes = ['vendor-managment'];
$isVendorActive = in_array($currentRoute, $vendorMenuRoutes);

$employeeMenuRoutes = ['employee'];
$isEmployeeActive = in_array($currentRoute, $employeeMenuRoutes);

$operationMenuRoutes = [ 'assign-asset','assets-assign', 'assets-stock','wip.index'];
$isOperationActive = in_array($currentRoute, $operationMenuRoutes);


@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
        <img src="{{ asset('assets/dist/img/logo.png') }}" alt="Acme Mine" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Acme Mine</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{ $currentRoute === 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $isMasterActive ? 'menu-is-opening menu-open' : '' }}">
                        <i class="nav-icon fas fa-recycle"></i>
                        <p>
                            Master
                            <i class="fas fa-angle-right right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isMasterActive ? 'display:block' : '' }}">
                        <li class="nav-item">
                            <a href="{{route('quc-managment')}}" class="nav-link {{ $currentRoute === 'quc-managment' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>UOM List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('credit-days')}}" class="nav-link {{ $currentRoute === 'credit-days' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Credit Days </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('department')}}" class="nav-link {{ $currentRoute === 'department' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('designation')}}" class="nav-link {{ $currentRoute === 'designation' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Designation</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{route('product')}}" class="nav-link {{ $currentRoute === 'product' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li> --}}
                        <!--<li class="nav-item">-->
                        <!--    <a href="{{route('unit')}}" class="nav-link {{ $currentRoute === 'unit' ? 'active' : '' }}">-->
                        <!--        <i class="far fa-circle nav-icon"></i>-->
                        <!--        <p> Unit</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!-- <li class="nav-item">-->
                        <!--    <a href="{{route('volume')}}" class="nav-link {{ $currentRoute === 'volume' ? 'active' : '' }}">-->
                        <!--        <i class="far fa-circle nav-icon"></i>-->
                        <!--        <p> Volume</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="nav-item">
                            <a href="{{route('mine')}}" class="nav-link {{ ($currentRoute === 'mine' || $currentRoute === 'add-mine' || $currentRoute === 'edit-mine') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mines</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('assets-category')}}" class="nav-link {{ $currentRoute === 'assets-category' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assets Category</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{route('machinery-assets')}}" class="nav-link {{ ($currentRoute === 'machinery-assets' || $currentRoute === 'machinery-assets-add' || $currentRoute === 'machinery-assets-edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Machinery/Assets list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('customer-managment')}}" class="nav-link {{ $currentRoute === 'customer-managment' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon "></i>
                                <p>Customer Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('vendor-managment')}}" class="nav-link {{ $currentRoute === 'vendor-managment' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vendor Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employee')}}" class="nav-link {{ $currentRoute === 'employee' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon "></i>
                                <p>Employee Management</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $isDailyRegisterActive ? 'menu-is-opening menu-open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Daily Register
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isDailyRegisterActive ? 'display:block' : '' }}">

                      <li class="nav-item">
                            <a href="{{route('dispatch-register')}}" class="nav-link {{ $currentRoute === 'dispatch-register' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disapatch Register</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('dumpermachine-register')}}" class="nav-link {{ $currentRoute === 'dumpermachine-register' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dumper &M/C Working Register</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="{{route('meter-reading')}}" class="nav-link {{ $currentRoute === 'meter-reading' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Meter Reading Register</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{route('diesel-stock')}}" class="nav-link {{ $currentRoute === 'diesel-stock' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Diesel Stock Register</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{route('wiresaw')}}" class="nav-link {{ $currentRoute === 'wiresaw' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Wire Saw Registor</p>
                            </a>
                        </li>

                    </ul>
                </li>

           <!--<li class="nav-item">-->
           <!--         <a href="#" class="nav-link {{ $isMineActive ? 'menu-is-opening menu-open' : '' }}">-->
           <!--             <i class="nav-icon fas fa-copy"></i>-->
           <!--             <p>-->
           <!--                 Mines-->
           <!--                 <i class="fas fa-angle-right right"></i>-->
           <!--             </p>-->
           <!--         </a>-->
           <!--         <ul class="nav nav-treeview" style="{{ $isMineActive ? 'display:block' : '' }}">-->
                        

                       

           <!--         </ul>-->
           <!--     </li>-->

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link {{ $isAssetActive ? 'menu-is-opening menu-open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Asset Managment
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isAssetActive ? 'display:block' : '' }}">

                      


                        <li class="nav-item">
                        <a href="{{route('assign-asset')}}" class="nav-link {{ $currentRoute === 'assign-asset' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Assets</p>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a href="{{route('assets-assign')}}" class="nav-link {{ $currentRoute === 'assets-assign' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Assets</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('assets-stock')}}" class="nav-link {{ $currentRoute === 'assets-stock' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assets Stock Master</p>
                        </a>
                    </li>
                    </ul>
                </li> --}}
                

                <!--<li class="nav-item">v-->
                <!--    <a href="#" class="nav-link {{ $isCutomerActive ? 'menu-is-opening menu-open' : '' }}">-->
                <!--        <i class="nav-icon fas fa-table"></i>-->
                <!--        <p>-->
                <!--            Customer Management-->
                <!--            <i class="fas fa-angle-right right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview" style="{{ $isCutomerActive ? 'display:block' : '' }}">-->

                        

                <!--    </ul>-->
                <!--</li>-->
                  

               
                
                <li class="nav-item">
                      <a href="#" class="nav-link {{ $isOperationActive ? 'menu-is-opening menu-open' : '' }}">
                          <i class="nav-icon fas fa-money-bill"></i>
                          <p>
                              Operation
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                           <li class="nav-item">
                        <a href="{{route('assets-assign')}}" class="nav-link {{ $currentRoute === 'assets-assign' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Assets</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('assets-stock')}}" class="nav-link {{ $currentRoute === 'assets-stock' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assets Stock Master</p>
                        </a>
                    </li>
                    
                       <li class="nav-item">
                            <a href="{{route('wip.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                            <p>Work In Progress Form</p>
                            </a>
                            </li>
                            <li class="nav-item">
                           <a href="{{route('wip.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Stock Update</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{route('sell-register')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sell Register</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{route('invoice-generate')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice Generator</p>
                            </a>
                            </li>
                         
                      </ul>

                  </li>
                  
                  
                 <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-money-bill"></i>
                          <p>
                              Finance
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                           <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Direct
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('reports.diesel-stock')}}" class="nav-link {{ $currentRoute === 'expense-category' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Diesel Stock</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('reports.assets-vendor')}}" class="nav-link {{ $currentRoute === 'assets-vendor' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assets Vendor</p>
                                    </a>
                                </li>
                                <!--<li class="nav-item">-->
                                <!--    <a href="{{route('reports.diesel-stock')}}" class="nav-link {{ $currentRoute === 'expense-category' ? 'active' : '' }}">-->
                                <!--        <i class="far fa-circle nav-icon"></i>-->
                                <!--        <p>Assets Vendor</p>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--    <a href="{{route('reports.diesel-stock')}}" class="nav-link {{ $currentRoute === 'expense-category' ? 'active' : '' }}">-->
                                <!--        <i class="far fa-circle nav-icon"></i>-->
                                <!--        <p>Assets Vendor</p>-->
                                <!--    </a>-->
                                <!--</li>-->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>In Direct
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('reports.employee-salary-report')}}" class="nav-link {{ $currentRoute === 'expense-category' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Salary Report</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('reports.expense-report')}}" class="nav-link {{ $currentRoute === 'expense-category' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expense Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                          <!--<li class="nav-item">-->
                          <!--    <a href="{{route('expense')}}" class="nav-link">-->
                          <!--        <i class="far fa-circle nav-icon"></i>-->
                          <!--        <p>Finance Pg2</p>-->
                          <!--    </a>-->
                          <!--</li>-->


                      </ul>
                  </li>
                  
                  
                  
                <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-file-code"></i>
                          <p>
                              Reports 
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                           <li class="nav-item">
                            <a href="{{route('expense-category')}}" class="nav-link {{ $currentRoute === 'expense-category' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report1</p>
                            </a>
                        </li>
                          <li class="nav-item">
                              <a href="{{route('expense')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Report2</p>
                              </a>
                          </li>
                      </ul>

                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link {{ $isDailyRegisterActive ? 'menu-is-opening menu-open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Role Permission
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isDailyRegisterActive ? 'display:block' : '' }}">

                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ $currentRoute === 'user' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link {{ $currentRoute === 'user' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permission.index') }}"
                                class="nav-link {{ $currentRoute === 'user' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role-permission.index') }}"
                                class="nav-link {{ $currentRoute === 'user' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role Permission</p>
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
