<?php

namespace SiPondok\controllers;

use common\models\LoginForm;
use SiPondok\models\usersModel;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $defaultAction = 'dashboard';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

     /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $this->layout = 'main-login';
    
        $model = new LoginForm();
    
        if ($model->load(Yii::$app->request->post())) {
            $user = usersModel::findOne(['username' => $model->username]);
    
            if ($user && $user->validatePassword($model->password)) {
                Yii::$app->user->login($user);
                return $this->goBack();
            }
    
            Yii::$app->session->setFlash('error', 'Username atau password salah.');
        }
    
        $model->password = '';
    
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
