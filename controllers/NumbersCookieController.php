<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;

use app\models\RandNumbers; // Используем из пространства модель для работы с таблицей рандомных чисел 
use yii\web\Response;       // Для изменения типа ответа

// use yii\web\Request;

/**
 * Контроллер для работы с рандомными числами
*/
class NumbersCookieController extends Controller
{
    /**
     * Генерирует рандомное число и сохраняет его в Cookie
     * @return array
     */
    public function actionGenerate()
    {
        //! Закомментировать строчку, если нужно в формате XML
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Генерация случайного числа
        $randomNumber = rand(); 
        // Создание уникального идентификатора
        $id = uniqid();

        // Установка куки с идентификатором
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => $id,
            'value' => $randomNumber,
            'expire' => time() + 3600,
        ]));

        // Возвращаем результат
        return ['id' => $id, 'number' => $randomNumber];
    }

    /**
     * Возвращает число по id
     * @param string $id по нему находиться в Cookie рандомное число
     * @return array 
    */
    public function actionRetrieve($id)
    {
        //! Закомментировать строчку, если нужно в формате XML
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Проверяем, существует ли куки с именем id
        if (!Yii::$app->request->cookies->has($id)) {
            // Если куки не существует, возвращаем ошибку
            Yii::$app->response->statusCode = 404; // Устанавливаем статус код ответа 404 (Not Found)
            
            return ['error' => 'Куки не найдены или время жизни истекло'];
        }

        // Извлекаем значение идентификатора из куки
        $randomNumber = Yii::$app->request->cookies->getValue($id);

        // Возвращаем результат в формате JSON
        return ['id' => $id, 'number' => $randomNumber];
    }

    /**
     * Возврат всех данных из cookies
     * @return array 
    */
    public function actionAll()
    {
        //! Закомментировать строчку, если нужно в формате XML
        Yii::$app->response->format = Response::FORMAT_JSON;

        // получаем все данные
        $data = Yii::$app->request->cookies;

        // Возвращаем результат
        return $data;
    }
}