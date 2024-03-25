<?php

namespace app\controllers;

use yii\rest\Controller;

use app\models\RandNumbers; // Используем из пространства модель для работы с таблицей рандомных чисел 
use yii\web\Response;       // Для изменения типа ответа

/**
 * Контроллер для работы с рандомными числами
*/
class NumbersController extends Controller
{
    /**
     * Генерирует рандомное число и сохраняет его в БД
     * @return array
     */
    public function actionGenerate()
    {
        // Генерация случайного числа
        $randomNumber = rand(); 
        // Сохранение результата в БД
        $model = new RandNumbers(['number' => $randomNumber]);
        $model->save();

        //! Закомментировать строчку, если нужно в формате XML
        \Yii::$app->response->format = Response::FORMAT_JSON;

        // Возвращаем результат
        return ['id' => $model->id, 'number' => $model->number];
    }

    /**
     * Возвращает число по id
     * @param string $id по нему находиться в БД рандомное число
     * @return array 
    */
    public function actionRetrieve($id)
    {
        // Получаем рандомное число по id из таблицы
        $model = RandNumbers::findOne($id);
        // В случае, если нет числа с таким id, возвращаем ответ что число не найдено
        if (!$model) {
            return ['error' => 'Number not found'];
        }

        //! Закомментировать строчку, если нужно в формате XML
        \Yii::$app->response->format = Response::FORMAT_JSON;

        // Возвращаем результат
        return ['id' => $model->id, 'number' => $model->number];
    }
}