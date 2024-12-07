  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('assets/dist/img/logo.png') }}" alt="Acme Mine" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Acme Mine</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                      <a href="{{route('dashboard')}}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-recycle"></i>
                          <p>
                              Master
                              <i class="fas fa-angle-right right"></i>

                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('assets-category')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Assets Category</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{route('quc-managment')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>UQC List</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{route('credit-days')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Credit Days </p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{route('expense-category')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Expense Category</p>
                              </a>
                          </li>

                             <li class="nav-item">
                              <a href="{{route('product')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>product</p>
                              </a>
                          </li>



                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Mines
                              <i class="fas fa-angle-right right"></i>

                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('list-mine-managment')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List Mines</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{route('mine-machinary-assets-list-managment')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Machinery/Assets list</p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('assign-asset')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assign Assets</p>
                            </a>
                        </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              Customer Management
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{route('customer-managment')}}" class="nav-link">
                              <i class="far fa-circle nav-icon "></i>
                                  <p>Customer  List</p>
                              </a>
                          </li>

                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              Vendor Management
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{route('vendor-managment')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Vendor List</p>
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
