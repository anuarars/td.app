






<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-table.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#">{{Auth::user()->name}}</a>
        <a class="navbar-brand brand-logo-mini" href="#">{{Auth::user()->name}}></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Выйти
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Главная</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.category.index')}}">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title">Категории</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.user.index')}}">
              <i class="ti-pencil-alt2 menu-icon"></i>
              <span class="menu-title">Организации</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.order.index')}}">
              <i class="ti-support menu-icon"></i>
              <span class="menu-title">Заявки</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.subscribe.index')}}">
              <i class="ti-pencil-alt menu-icon"></i>
              <span class="menu-title">Подписки</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.page.index')}}">
              <i class="ti-comment menu-icon"></i>
              <span class="menu-title">Страницы</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 Все права защищены</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <style>
    .bootstrap-table .fixed-table-container .table tbody tr .card-view .card-view-title {
        font-weight: 700;
        display: inline-block;
        min-width: 60%!important;
        text-align: left!important;
    }
    .upload-logo-wrap{
        width: 40%; 
        position: relative;
        text-align: center;
    }
    .upload-logo{
      display: inline-block;
      position: absolute;
      z-index: 1;
      width: 100%;
      height: 50px;
      top: 0;
      left: 0;
      opacity: 0;
      cursor: pointer;
    }
    .label{
        position: relative;
        z-index: 0;
        display: inline-block;
        width: 100%;
        background: #00bfff;
        cursor: pointer;
        color: #fff;
        padding: 10px 0;
        text-transform:uppercase;
        font-size:12px;
    }
  </style>
  <!-- plugins:js -->
    <script src="{{asset('admin/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
    <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
    <script src="{{asset('admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('admin/js/template.js')}}"></script>
<script src="{{asset('admin/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
<script src="{{asset('admin/js/dashboard.js')}}"></script>
<script src="{{asset('admin/js/bootstrap-table.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap-table-mobile.min.js')}}"></script>
<script>
    $(function() {
      $('#table').bootstrapTable()
    });

    $('#product_more').click(function(){
        $('.product-row').append('<tr><td><input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]"></td><td><input type="number" name="product_price[]" class="form-control"></td><td><textarea name="product_description[]" rows="2" placeholder="Описание Единицы" class="form-control"></textarea></td></tr>');
    });

    $( "#integer" ).change(function() {
        if($(this).val() !== ('1')) {
            $(".measureItem").css('display', 'none');
            $(".measureItems").css('display', 'block');
        }else if($(this).val() == ('1')){
            $(".measureItem").css('display', 'block');
            $(".measureItems").css('display', 'none');
        }
    });
</script>
  <!-- End custom js for this page-->
</body>

</html>