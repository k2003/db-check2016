<?php
$this->title = Yii::t('app', 'ตรวจสอบแฟ้ม person และ patientt');
$this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบ43แฟ้ม', 'url' => ['check/index']];
$this->params['breadcrumbs'][] = 'ตรวจสอบแฟ้ม person และ patient';

use yii\helpers\Html;
?>
<div class="alert alert-primary">
     <h4>ตรวจสอบ แฟ้ม PERSON และ PATIENT</h4>
    <h6><p><font color="#FFFFFF">ข้อมูลทั่วไปของประชาชนในเขตรับผิดชอบและผู้ที่มาใช้บริการ ประกอบด้วย (1. ประชาชนทุกคนที่อาศัยในเขตรับผิดชอบ,2.ประชาชนทุกคนที่มีชื่ออยู่ในทะเบียนบ้านในเขตรับผิดชอบ 3.ผู้มารับบริการที่อาศัยอยู่นอกเขตรับผิดชอบ)  เขตรับผิดชอบ ในส่วนของโรงพยาบาล หมายถึง ตำบลที่ตั้งของโรงพยาบาล หรือพื้นที่รับผิดชอบในส่วนของบริการระดับปฐมภูมิ
            เก็บข้อมูลโดยการสำรวจ  กำหนดให้ทำการสำรวจปีละ 1  ครั้ง ภายในเดือนสิงหาคม  และปรับฐานข้อมูลให้แล้วเสร็จภายในวันที่  1 ตุลาคม ของทุกปี</font></p></h6>
</div>

  <?php echo Html::a('PERSON', ['person/index1'], ['class' => 'btn btn-warning']); 
echo Html::a('PATIENT', ['person/index2'], ['class' => 'btn btn-warning']); ?> <br>


