
<?php
$this->title = Yii::t('app', 'การตรวจคัดกรองมะเร็งปากมดลูกในสตรี 30-60 ปี');
$this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบ qof', 'url' => ['qof/index']];
$this->params['breadcrumbs'][] = 'การตรวจคัดกรองมะเร็งปากมดลูกในสตรี 30-60 ปี';

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;

?>
<div class="alert alert-primary">
     <h4><font color="#FFFF00">คัดกรองมะเร็งปากมดลูกในสตรีสัญชาติไทย 30-60 ปี ภายใน 5 ปี (ผู้รับผิดชอบ ประนอม เฉิดสถิตย์)</font></h4>
     <h6><p><font color="#FFFFFF">คัดกรองมะเร็งปากมดลูกในสตรีสัญชาติไทย ทุกสิทธิที่มีอายุ 30-60 ปี ประชากรในเขตรับผิดชอบ
                  (ช่วง 1 เมษายน 2558 ถึง 31 มีนาคม 2559) เกณฑ์เป้าหมายไม่น้อยกว่าร้อยละ 80 [รหัสที่ให้ ICD-10 Z014 และ Z124]</font></p></h6>
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
                return  Html::a(Html::encode($model['b']),['/qof/goal103' ,'id'=>$model['village_id']]);
            }// end value
        ],
        [
            'label' => 'ผลงาน  (คน)',
            'format' => 'raw',
            'value' => function($model) use($date1,$date2){
                return  Html::a(Html::encode($model['a']),['/qof/result103' ,'id'=>$model['village_id'], 'date1' => $date1, 'date2' => $date2]);
            }// end value
        ]
    ]
]);

