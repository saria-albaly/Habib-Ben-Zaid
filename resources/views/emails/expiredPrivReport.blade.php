<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Defualt Bank Font -->
  <link rel="stylesheet" href="{{ asset('dist/css/fonts.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-red.min.css') }}">

<div class="col-md-12" style="text-align: right;direction: rtl;">
  <h3 style="font-family: 'Janna LT'"> تحية طيبة وبعد ...</h3>
  <h4 style="font-family: 'Janna LT'"> نحيطكم علما بإنتهاء صلاحية الصلاحيات التالية:</h4>
  <h4 style="font-family: 'Janna LT'">صلاحيات الأقسام:</h4>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="text-align: right;">#</th>
        <th style="text-align: right;">اسم القسم</th>
        <th style="text-align: right;">اسم الوثيقة</th>
        <th style="text-align: right;">اسم الصلاحية</th>
        <th style="text-align: right;">تاريخ إنشاء الصلاحية</th>
        <th style="text-align: right;">تاريخ انتهاء الصلاحية</th>
        <th style="text-align: right;">الفقرات</th>
      </tr>
      </thead>
      <tbody>
      <?php $i=1; ?>    
      @isset($a_dep)
        @foreach($a_dep as $a_dep_s)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$a_dep_s->department_name}}</td>
            <td>{{$a_dep_s->document_name}}</td>
            <td>{{$a_dep_s->action_name}}</td>
            <td>{{$a_dep_s->p_created_at}}</td>
            <td>{{$a_dep_s->expire_date}}</td>
            <td>{{$a_dep_s->array_section_ids}}</td>    
          </tr>
        @endforeach  
      @endisset 
      </tbody>
    </table>

    <h4 style="font-family: 'Janna LT'">صلاحيات المستخدمين:</h4>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="text-align: right;">#</th>
        <th style="text-align: right;">اسم المستخدم</th>
        <th style="text-align: right;">اسم الوثيقة</th>
        <th style="text-align: right;">اسم الصلاحية</th>
        <th style="text-align: right;">تاريخ إنشاء الصلاحية</th>
        <th style="text-align: right;">تاريخ انتهاء الصلاحية</th>
        <th style="text-align: right;">الفقرات</th>
      </tr>
      </thead>
      <tbody>
      <?php $i=1; ?>    
      @isset($a_user)
        @foreach($a_user as $a_user_s)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$a_user_s->name}}</td>
            <td>{{$a_user_s->document_name}}</td>
            <td>{{$a_user_s->action_name}}</td>
            <td>{{$a_user_s->p_created_at}}</td>
            <td>{{$a_user_s->expire_date}}</td>
            <td>{{$a_user_s->array_section_ids}}</td>    
          </tr>
        @endforeach  
      @endisset 
      </tbody>
    </table>
  <h5 style="font-family: 'Janna LT'">تم إرسال هذا البريد بشكل تلقائي من قبل نظام السياسات والإجراءات</h3>
</div>