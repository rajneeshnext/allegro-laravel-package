@extends('allegro::layouts.admin.app')

@section('content')
       <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> My Auction </h3>
              </div>

              <!--div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div-->
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Auction</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <!--a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a-->
                        <!--ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul-->
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!--p class="text-muted font-13 m-b-30">
                      Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                    </p-->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>name</th>
                          <th>Selling Mode</th>
                          <th>Amount</th>
                          <th>Currency</th>
                          <th>Stock</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($auctions->items->promoted))
                        @foreach($auctions->items->promoted as $auction)
                        <tr>
                          <td>{{ $auction->id }}</td>
                          <td>{{ $auction->name }}</td>
                          <td>{{ $auction->sellingMode->format }}</td>
                          <td>{{ $auction->sellingMode->price->amount }}</td>
                          <td>{{ $auction->sellingMode->price->currency }}</td>
                          <td>{{ $auction->stock->available }}</td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
          
          
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection        