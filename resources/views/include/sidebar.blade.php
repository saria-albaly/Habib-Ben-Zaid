  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-right image">
          <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>لؤي الاسدي</p>
          مدير النظام
          <!-- Status -->
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <!-- <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span> -->
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="text-align: right;">لوحة التحكم </li>
        <!-- Optionally, you can add icons to the links -->
          <li class="treeview" style="text-align: right;direction: rtl;" >
            <a href="#"><i class="fa fa-cogs"></i> <span style="z-index: 1000;">الإدارة العامة</span>
              <span class="pull-left-container">
                  <i class="fa fa-angle-left pull-left"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url('years')}}"     style="background-color: white !important;">إدارة السنوات</a></li>
                <li><a href="{{url('semesters')}}" style="background-color: white !important;">إدارة الفصول</a></li>
                <li><a href="{{url('teachers')}}"  style="background-color: white !important;">إدارة الأساتذة</a></li>
                <li><a href="{{url('student')}}"  style="background-color: white !important;">إدارة الطلاب</a></li>
                <li><a href="{{url('courses')}}"   style="background-color: white !important;">إدارة الحلقات</a></li>
                <li><a href="{{url('activities')}}"   style="background-color: white !important;">إدارة النشاطات</a></li>
                <li><a href="{{url('settings')}}"   style="background-color: white !important;">إعدادات</a></li>
            </ul>
        </li>
        <li class="treeview" style="text-align: right;direction: rtl;">
          <a href="#"><i class="fa fa-ticket"></i> <span style="z-index: 1000;">إدارة الفصل</span>
            <span class="pull-left-container">
                <i class="fa fa-angle-left pull-left"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="{{url('semester/activities')}}" style="background-color: white !important;">النشاطات</a></li>
              <li><a href="{{url('semester/points')}}" style="background-color: white !important;">النقاط</a></li>
              <li><a href="{{url('semester/recite')}}" style="background-color: white !important;">التسميعات</a></li>
              <li><a href="{{url('semester/absences')}}" style="background-color: white !important;">تقرير غيابات الطلاب</a></li>
              <li><a href="{{url('semester/absences')}}" style="background-color: white !important;">تسجيل حضور الطلاب</a></li>
          </ul>
        </li>
          <li class="treeview" style="text-align: right;direction: rtl;">
            <a href="#"><i class="fa fa-file"></i> <span style="z-index: 1000;">أخرى</span>
              <span class="pull-left-container">
                  <i class="fa fa-angle-left pull-left"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('awqaf')}}" style="background-color: white !important;">سبر الأوقاف</a></li>
              <li><a href="{{url('checks')}}" style="background-color: white !important;">شيكات النقاط</a></li>
              <li><a href="{{url('general_files')}}" style="background-color: white !important;">ملفات الدورة</a></li>
              <!-- <li><a href="#">Link in level 2</a></li> -->
            </ul>
          </li>
        <li class="treeview" style="text-align: right;direction: rtl;">
          <a href="#"><i class="fa fa-area-chart"></i> <span style="z-index: 1000;">الاحصائيات</span>
            <span class="pull-left-container">
                <i class="fa fa-angle-left pull-left"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('statistics/1')}}" style="background-color: white !important;">#1</a></li>
            <li><a href="{{url('statistics/2')}}" style="background-color: white !important;">#2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>