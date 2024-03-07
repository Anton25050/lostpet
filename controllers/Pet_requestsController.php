<?php

namespace app\controllers;

use app\models\Pet_requests;
use app\models\Pet_requestsSearch;
use app\models\Status;
use yii\web\Controller;
use app\models\User;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Pet_requestsController implements the CRUD actions for Pet_requests model.
 */
class Pet_requestsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pet_requests models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = User::getInstance();
        if (!$user) {
            return $this->goHome();
        }
        $searchModel = new Pet_requestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $user->id);

        if($user->isAdmin()) {
            $dataProvider = $searchModel->search($this->request->queryParams);
        

        return $this->render('index_admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

        $dataProvider = $searchModel->search($this->request->queryParams, $user->id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
}
    /**
     * Displays a single Pet_requests model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->redirect('index');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pet_requests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pet_requests();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status_id = Status::NEW_STATUS_ID;
                $model->user_id = User::getInstance()->id; 
                if ($model->save()) {
                    return $this->redirect(['/pet_requests/index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            if (
                isset($model->getDirtyAttributes()["status_id"])
                &&
                in_array(
                    $model->getDirtyAttributes()["status_id"],
                    [Status::FOUNDED_STATUS_ID, Status::NOTFOUNDED_STATUS_ID]
                )
                &&
                !$model->admin_message
            ) {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->redirect(['index']);

        // return $this->render('update', [
            // 'model' => $model,
        // ]);
    }


    /**
     * Finds the Pet_requests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pet_requests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pet_requests::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Такой страницы не существует');
    }
}
