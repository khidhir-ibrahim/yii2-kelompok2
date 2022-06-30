<?php

namespace app\controllers;
use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
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
     * Lists all Account models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        if(Yii::$app->user->identity->role !== 'admin'){
            return "Anda tidak memiliki akses untuk halaman ini!";
            die();
        }

        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param string $username Username
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($username)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        if(Yii::$app->user->identity->role !== 'admin'){
            return "Anda tidak memiliki akses untuk halaman ini!";
            die();
        }
        return $this->render('view', [
            'model' => $this->findModel($username),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        if(Yii::$app->user->identity->role !== 'admin'){
            return "Anda tidak memiliki akses untuk halaman ini!";
            die();
        }
        $model = new Account();

        if ($this->request->isPost) {
            
            $data = [
                '_csrf'         => $this->request->post()['_csrf'],
                'Account'       => [
                    'username'  => $this->request->post()['Account']['username'],
                    'password'  => md5($this->request->post()['Account']['password']),
                    'name'      => $this->request->post()['Account']['name'],
                    'role'      => $this->request->post()['Account']['role'],
                ]
            ];

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['view', 'username' => $model->username]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $username Username
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($username)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        if(Yii::$app->user->identity->role !== 'admin'){
            return "Anda tidak memiliki akses untuk halaman ini!";
            die();
        }
        $model = $this->findModel($username);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'username' => $model->username]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $username Username
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($username)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        if(Yii::$app->user->identity->role !== 'admin'){
            return "Anda tidak memiliki akses untuk halaman ini!";
            die();
        }
        $this->findModel($username)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $username Username
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        if (($model = Account::findOne(['username' => $username])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
