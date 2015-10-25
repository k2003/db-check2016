<?php
$this->title = Yii::t('app', 'ตรวจสอบแฟ้ม nutrition');
$this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบ 43 แฟ้ม', 'url' => ['oppp/index']];
$this->params['breadcrumbs'][] = 'ตรวจสอบแฟ้ม nutrition';

use yii\helpers\Html;
?>
<div class="alert alert-primary">
    <h4><font color="#FFFF00">ตรวจสอบ แฟ้ม NUTRITION</font></h4>
    <h6><p><font color="#FFFFFF">ข้อมูลการวัดระดับโภชนาการและพัฒนาการเด็กอายุ 0-5 ปี และนักเรียนในเขตรับผิดชอบ (การเก็บข้อมูล 1.เด็ก 0-5 ปี เก็บข้อมูลปีละ 4 ครั้ง ครั้งที่ 1 เดือนตุลาคม ,ครั้งที่ 2 เดือนมกราคม ครั้งที่ 3 เดือนเมษายน,ครั้งที่ 4 เดือนกรกฎาคม 2.อายุ 6 -18 ปี เก็บข้อมูลปีละ 2 ครั้ง ครั้งที่ 1 เทอมที่ 1 เดือนกรกฎาคม,ครั้งที่ 2 เทอมที่ 2 เดือนมกราคม)
            ตรวจสอบบัญชี3,4,5</font></p></h6>
</div>

  <?php echo Html::a('ตรวจสอบบัญชี 3', ['nutrition/nutri3'], ['class' => 'btn btn-warning']); 
  echo Html::a('ตรวจสอบบัญชี 4', ['nutrition/nutri4'], ['class' => 'btn btn-warning']); 
echo Html::a('ตรวจสอบบัญชี 5', ['nutrition/nutri5'], ['class' => 'btn btn-warning']); ?> <br>


