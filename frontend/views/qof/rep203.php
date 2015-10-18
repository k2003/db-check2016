
<?php
$this->title = Yii::t('app', 'อัตราการใช้บริการของผู้ป่วยในด้วยโรคเบาหวานที่มีภาวะแทรกซ้อนระยะสั้น สิทธิ UC');
$this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบ qof', 'url' => ['qof/index']];
$this->params['breadcrumbs'][] = 'อัตราการใช้บริการของผู้ป่วยในด้วยโรคเบาหวานที่มีภาวะแทรกซ้อนระยะสั้น สิทธิ UC';

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;

?>
<div class="alert alert-primary">
     <h4><font color="#FFFF00">อัตราการใช้บริการของผู้ป่วยในด้วยโรคเบาหวานที่มีภาวะแทรกซ้อนระยะสั้น สิทธิ UC (ผู้รับผิดชอบ รจนา   จันทรักษ์)</font></h4>
     <h6><p><font color="#FFFFFF">จำนวนครั้งของผู้ป่วยในด้วยโรคเบาหวานที่มีภาวะแทรกซ้อนระยะสั้น ซึ่งประกอบด้วยภาวะ Ketoacidosis,Hyperrosmolarity,Hypoglycemia,Coma อายุ 15 ปีขึ้นไป สิทธิ UC ที่ลงทะเบียนสิทธิหน่วยบริการประจำ
     ช่วง 1 เมษายน 2558 ถึง 31 มีนาคม 2559) เกณฑ์เป้าหมายน้อยกว่า 3.64 (รหัสที่ให้ 'E100'-'E101' OR 'E110'-'E111' OR 'E120'-'E121' OR 'E130'-'E131' OR 'E140'-'E141')</font></p></h6>
</div>
<div class='well'>
    <div class="row">
        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
        <div class="col-md-3">
            ระบุวันที่   
            <?php
            echo DatePicker::widget([
                'name' => 'date1',
                'value' => $date1,
                'language' => 'th',
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>

        <div class="col-md-3">
            ถึง
            <?php
            echo DatePicker::widget([
                'name' => 'date2',
                'value' => $date2,
                'language' => 'th',
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>

        <div class="col-md-2">
            <label><font color="#FFFF">.</font></label>
            <div class="input-group">
                <?= Html::submitButton('ประมวลผล') ?>
            </div><!-- /.input group -->
        </div>  
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        //'before' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reload', ['/dental/index'], ['class' => 'btn btn-info']),
        //'after' => 'วันที่ประมวลผล '.date('Y-m-d H:i:s').' น.',
    ],
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=> true,
        'beforeGrid'=>'',
        'afterGrid'=>'',
    ],
    'columns' => [
        [
            'class'=>'yii\grid\SerialColumn'
        ],
        [
            'attribute' => 'village_name',
            'header' => 'หมู่บ้าน'
        ],
        [
            'label' => 'เป้าหมาย (คน)',
            'format' => 'raw',
            'value' => function($model){
                return  Html::a(Html::encode($model['b']),['/qof/goal203' ,'id'=>$model['village_id']]);
            }// end value
        ],
        [
            'label' => 'ผลงาน  (คน)',
            'format' => 'raw',
            'value' => function($model) use($date1,$date2){
                return  Html::a(Html::encode($model['a']),['/qof/result203' ,'id'=>$model['village_id'], 'date1' => $date1, 'date2' => $date2]);
            }// end value
        ]
    ]
]);

