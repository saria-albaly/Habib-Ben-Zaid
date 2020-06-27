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
	<h4 style="font-family: 'Janna LT'">قام {{$user->name}} بقبول طلب التعديل التالي:</h4>
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
        <th style="text-align: right;">تاريخ بدء التعديل</th>
        <th style="text-align: right;">آخر موعد للتعديل</th>
        <th style="text-align: right;">الوقت المتبقي</th>
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
            <td>{{$editRequest->start_date}}</td>
            <td>{{$editRequest->expire_date}}</td>    
            <td style="text-align: right;direction: rtl;">
              <?php 
                $checkDates= true;
                if(isset($editRequest->expire_date)){
                  $date1 = new DateTime($editRequest->start_date);
                  $date2 = new DateTime($editRequest->expire_date);
                  $currentDate = new DateTime();
                  $currentDate->setTimeZone(new DateTimeZone('Asia/Damascus'));
                  $diff = $date2->diff($currentDate);
                  echo $diff->format('%a يوماً و %h ساعة');
                }
                else{
                  $checkDates= false;
                  if($editRequest->request_status == 'pending')
                    echo "بانتظار الحصول على الموافقة" ;
                  if($editRequest->request_status == 'cancelled')
                    echo "تم إلغاء الطلب" ;
                }
              ?>
            </td>
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
                      @if($editRequest->document->document_type->id == 5)
	                      <a href="{{url('DocumentEditRequest/policies-requests')}}" target="_blank" style="padding: 8px 12px; border: 1px solid #ED2939;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
	                          عرض طلبات التعديل
	                      </a>
                      @else
                        <a href="{{url('DocumentEditRequest/requests')}}" target="_blank" style="padding: 8px 12px; border: 1px solid #ED2939;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
                            عرض طلبات التعديل
                        </a>
                      @endif  
	                  </td>
	              </tr>
	          </table>
	      </td>
	  </tr>
	</table>
	<h5 style="font-family: 'Janna LT'">تم إرسال هذا البريد بشكل تلقائي من قبل نظام السياسات والإجراءات</h3>
</div>