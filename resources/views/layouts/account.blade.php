
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
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
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
           <li class="nav-item">
            @if (Auth::user()->hasRole('client'))
              <a class="nav-link count-indicator" href="#">
                Роль: Заказщик
              </a>
            @else
              <a class="nav-link count-indicator" href="#">
                Роль: Поставщик
              </a>
            @endif
           </li>
          <li class="nav-item">
            <a class="nav-link count-indicator" href="#">
              Баланс: {{Auth::user()->balance}} тг.
            </a>
          </li>
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
            <a class="nav-link" href="{{route('profile.edit', Auth::id())}}">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title">Профиль</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('subscribe.index')}}">
              <i class="ti-pencil-alt2 menu-icon"></i>
              <span class="menu-title">Изменить подписку</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ti-support menu-icon"></i>
              <span class="menu-title">Пополнить Баланс</span>
            </a>
          </li>

          {{-- Для клиента --}}
          @if (Auth::user()->hasRole('client'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.order.index')}}">
                <i class="ti-check-box menu-icon"></i>
                <span class="menu-title">Все Заказы</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.order.create')}}">
                  <i class="ti-marker-alt menu-icon"></i>
                  <span class="menu-title">Создать Заказ</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('client.order.requests')}}">
                  <i class="ti-reload menu-icon"></i>
                  <span class="menu-title">Все Предложения</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('client.chat.index')}}">
                  <i class="ti-menu-alt menu-icon"></i>
                  <span class="menu-title">Чат Расписание</span>
                </a>
              </li>
          @endif

          @if (Auth::user()->hasRole('worker'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('worker.category.create')}}">
                <i class="ti-bag menu-icon"></i>
                <span class="menu-title">Категории</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('worker.account.orders')}}">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Заказы из подписок</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('worker.account.offers')}}">
              <i class="ti-write menu-icon"></i>
              <span class="menu-title">Поданные заявки</span>
              </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('worker.chat.index')}}">
                <i class="ti-view-list-alt menu-icon"></i>
                <span class="menu-title">Чат Раписание</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('worker.protocol.list')}}">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Протоколы</span>
              </a>
          </li>
          @endif
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
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<script>
    $(function() {
      $('#table').bootstrapTable()
    });

    var counter = 9;

    $('#product_more').click(function(){
        $('.product-row').append('<tr><td><div class="form-control text-center ids">' + counter + '</div></td><td><input type="text" class="form-control" placeholder="Название Единицы" name="product_name[]"></td><td><input name="product_description[]" rows="2" placeholder="Описание Единицы" class="form-control"></td><td><input type="text" name="product_measure[]" class="form-control"></td><td><input type="number" name="product_count[]" class="form-control"></td></tr>');

        counter += 1;
    });

    $(".multiple-select select").multipleSelect({
        filter: true,
        minimumCountSelected: 5,
        selectAll: false,
        allSelected: 'Выбрано все',
        displayDelimiter: ' | ',
        animate: 'fade',
        placeholder: 'Выберите Категории'
    });
</script>
  <!-- End custom js for this page-->
</body>

</html>





























