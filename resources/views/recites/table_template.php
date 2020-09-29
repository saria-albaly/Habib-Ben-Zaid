<?php $i=1 ?>  
<?php if(isset($student_absence_array)) : ?>
  <?php foreach ($student_absence_array as $absence_log): ?>
    <tr>
      <td><?= $absence_log->student_id?></td>
      <td style="direction:ltr"><?= $absence_log->student->student_name?></td>
      <td style="direction:ltr"><?= $absence_log->course->class_name?></td>
      <td style="direction:ltr"><?= $absence_log->created_at?></td>
      <td style="direction:ltr<?php if($absence_log && $absence_log->point->point_code == "ontime") echo ";color:green"; else echo ";color:red"; ?>" > <?= $absence_log->point->point_name?></td> 
      <td>
        <form action="<?=  url('/semester/absences/'.$absence_log->id) ?>" method="POST" style="display: contents;" class="delete_form">
          <?=  method_field('DELETE') ?>
          <button type="submit" class="btn btn-danger btn-flat delete" title="حذف الوثيقة"><i class="fa fa-trash-o"></i></button>
        </form>
      </td>
    </tr>
  <?php endforeach ?>
<?php endif ?>