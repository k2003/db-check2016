<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\db\Query;
use Yii;
use yii\data\ArrayDataProvider;

class StudentController extends Controller {
    public function actionIndex() {
        $role = isset(Yii::$app->user->identity->role) ? Yii::$app->user->identity->role : 99;
        if ($role == 99) {
            throw new \yii\web\ConflictHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งานส่วนนี้ กรุณาติดต่อผู้ดูแลระบบ !');
        } 
          
        $sql = "SELECT a.person_id  AS pid 
        ,p.cid
        ,concat(p.pname,p.fname,' ',p.lname) AS full_name
        ,vs.school_name
        ,vc.village_school_class_name AS class
        ,a.last_update AS d_update
        from village_student   a
        left outer join person p on p.person_id = a.person_id
        left outer join house h on h.house_id = p.house_id
        left outer join village v on v.village_id = p.village_id
        left outer join thaiaddress t on t.addressid = v.address_id
        left outer join village_school vs on vs.village_school_id = a.village_school_id
        left outer join village_school_type vt on vt.school_type_id = vs.school_type_id
        left outer join village_school_class vc on vc.village_school_class_id = a.village_school_class_id
        left outer join village_school_room vr on vr.village_school_room_id = a.village_school_room_id
        left outer join village ve on ve.village_id=vs.village_id
        where (a.discharge<>'Y' or a.discharge is null)
        order by a.village_school_id,a.village_school_class_id,a.village_school_room_id";

        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
    public function actionView($id=NULL) {
        $role = isset(Yii::$app->user->identity->role) ? Yii::$app->user->identity->role : 99;
        if ($role == 99) {
            throw new \yii\web\ConflictHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งานส่วนนี้ กรุณาติดต่อผู้ดูแลระบบ !');
        } 
        
        $sql = "select (SELECT hospitalcode FROM opdconfig) AS hospcode,
        a.person_id  as pid,
        CONCAT(p.pname,p.fname,' ',p.lname) AS full_name,
        concat(ve.address_id,
        a.village_school_id)AS schoolcode,
        IF(MONTH(CURDATE())>=5 AND MONTH(CURDATE()) <=12,YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))+543,YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))+542) AS educationyear,
        a.village_school_class_id AS class,
        a.last_update AS d_update,
        a.discharge_date AS grudate_date,
        p.cid AS id
        from village_student   a
        left outer join person p on p.person_id = a.person_id
        left outer join house h on h.house_id = p.house_id
        left outer join village v on v.village_id = p.village_id
        left outer join thaiaddress t on t.addressid = v.address_id
        left outer join village_school vs on vs.village_school_id = a.village_school_id
        left outer join village_school_type vt on vt.school_type_id = vs.school_type_id
        left outer join village_school_class vc on vc.village_school_class_id = a.village_school_class_id
        left outer join village_school_room vr on vr.village_school_room_id = a.village_school_room_id
        left outer join village ve on ve.village_id=vs.village_id
        where a.person_id ='$id' and (a.discharge<>'Y' or a.discharge is null)
        and (a.person_id='' or a.person_id is null  
        or ve.address_id='' or ve.address_id is null  
        or a.village_school_id='' or a.village_school_id is null 
        or a.village_school_class_id='' or a.village_school_class_id is null 
        or p.cid='' or p.cid is null)  
        order by a.village_school_id,a.village_school_class_id,a.village_school_room_id";
        
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        return $this->render('view', ['data_view' => $data]);
    }
}

