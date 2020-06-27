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
	<h4 style="font-family: 'Janna LT'">{{ $text }}</h4>
	<br>
  <h4 style="font-family: 'Janna LT'">التفاصيل:</h4>
  @isset($notes)
    <p style="font-family: 'Janna LT'">
      {{$notes}}
    </p>
  @endisset
  <br>
	<input type="hidden" name="id" value="{{ $editRequest->id }}">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="text-align: right;">#</th>
        <th style="text-align: right;">اسم الطلب</th>
        <th style="text-align: right;">سبب التعديل</th>
        <th style="text-align: right;">تفاصيل التعديل</th>
        <th style="text-align: right;">عنوان الوثيقة</th>
        <th style="text-align: right;">نوع الوثيقة</th>
      </tr>
      </thead>
      <tbody>
      <?php $i=1; ?>    
      @isset($editRequest)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$editRequest->edit_request_name}}</td>
            <td>{{$editRequest->edit_request_reason}}</td>
            <td>{{$editRequest->edit_request_details}}</td>
            <td>{{$editRequest->document->document_name}}</td>
            <td>{{$editRequest->document->document_type->doc_type_name}}</td>
          </tr>
      @endisset 
      </tbody>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0">
	  <tr>
	      <td>
	          <table cellspacing="0" cellpadding="0">
	              <tr>
	                  <td style="border-radius: 2px;" bgcolor="#ED2939">
                        <a href="{{url($link)}}" target="_blank" style="padding: 8px 12px; border: 1px solid #ED2939;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
                            عرض طلبات التعديل
                        </a>
	                  </td>
	              </tr>
	          </table>
	      </td>
	  </tr>
	</table>
	<h5 style="font-family: 'Janna LT'">تم إرسال هذا البريد بشكل تلقائي من قبل نظام السياسات والإجراءات</h3>
</div>