<!-- Menu toggle button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-envelope-o"></i>
  <span class="label label-success"><?php if(isset($user_notification)) echo $user_notification['unseen_count']; ?></span>
</a> 
 <ul class="dropdown-menu" style="width: 400px!important;">
  <li>
    <ul class="menu" style="width: 400px!important;">
      @isset($user_notification)
        @foreach ($user_notification['all_notes'] as $note)
          <li style="direction: rtl;text-align: right;" >
            @if (strpos($note->link, 'pending') !== false)
              <a href="{{url($note->link.'&refnote='.$note->id)}}">
            @elseif($note->link !='#')
              <a href="{{url($note->link.'?refnote='.$note->id)}}">
            @else
              <a onclick="refreshNotes({{$note->id}},0)">
            @endif
              <!-- <h4>
                طلب تعديل
                <small><i class="fa fa-clock-o"></i> 5 mins</small>
              </h4> -->
              @if($note->is_seen == 0)
                <span class="label label-danger" style="float: left;">جديد</span>
              @endif  
              <small><i class="fa fa-clock-o"></i> {{$note->created_at}}</small>
              <p style="white-space: normal;">{{$note->notification_name}}</p>
            </a>
          </li>
        @endforeach  
      @endisset
    </ul>
    
  </li>
  <li class="footer"><a onclick="refreshNotes(0,1)">تحديد الإشعارات كمقروءة</a></li>
</ul>
