  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content" style="direction: rtl;text-align: right;">
          <h3><i class="fa fa-warning text-yellow"></i> عذراً! المحتوى غير متوفر.</h3>

          <p style="direction: rtl;text-align: right;">
            لا نستطيع عرض الصفحة التي تحاول الوصول إليها.
            لذلك يمكنكم الضغط هنا  <a href="{{url('document')}}">للعودة للصفحة الرئيسية</a> أو اطلب الدعم الفني من قسم الIT.
          </p>

          <form class="search-form" action="{{url('reportIssue')}}" method="post">
            @csrf
            <textarea name="error_description" class="form-control" placeholder="توصيف المشكلة" style="width: 408px; height: 336px;resize: none;"></textarea>
            <br>
            <input type="text" name="url" class="form-control" placeholder="قم بنسخ الرابط في الأعلى">
            <br>
            <div class="input-group">
              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning "><i class="fa fa-bug"></i>
                  إرسال لقسم الدعم الفني
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>