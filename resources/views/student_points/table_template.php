<?php $i=1 ?>  
<?php if(isset($student_point_array)) : ?>
  <?php foreach ($student_point_array as $point_log): ?>
    <tr>
      <td><?= $point_log->student_id?></td>
      <td style="direction:ltr"><?= $point_log->student->student_name?></td>
      <td style="direction:ltr"><?= $point_log->course->class_name?></td>
      <td style="direction:ltr"><?= $point_log->created_at?></td>
      <td style="direction:ltr"><?=$point_log->point_cause?></td> 
      <td style="direction:ltr"><?=$point_log->point_amount?></td> 
      <td>
        <form action="<?=  url('/semester/points/'.$point_log->id) ?>" method="POST" style="display: contents;" class="delete_form">
          <?=  method_field('DELETE') ?>
          <input type="hidden" name="id" value="<?= $point_log->id ?> ">
          <button type="submit" class="btn btn-danger btn-flat delete" title="حذف نقاط الطالب"><i class="fa fa-trash-o"></i></button>
        </form>
      </td>
    </tr>
  <?php endforeach ?>
<?php endif ?>