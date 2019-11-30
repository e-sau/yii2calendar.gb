<?php


namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class ActivityForm extends Model
{
    public $title;
    public $startDay;
    public $endDay;
    public $body;
    public $repeat;
    public $main;
    public $files;

    public function rules()
    {
        return [
            [['title', 'startDay', 'body'], 'required'],
            [['title', 'body', 'repeat'], 'string'],
            [['startDay', 'endDay'], 'date', 'format' => 'php:Y-m-d'],
            [['main'], 'boolean'],
            [['files'], 'file', 'maxFiles' => 3]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название события',
            'startDay' => 'Дата начала',
            'endDay' => 'Дата завершения',
            'body' => 'Описание события',
            'repeat' => 'Повтор',
            'main' => 'Весь день'
        ];
    }

    /**
     * Метод сохраняет файлы на диск и возвращает имена файлов
     * @return array
     */
    public function upload()
    {
        $uploadedFiles = [];
        foreach ($this->files as $file) {
            // TODO: сохраняем файлы на диск
            $uploadedFiles[] = $file->baseName . '.' . $file->extension;
        }
        return $uploadedFiles;
    }

    /**
     * Метод проверяет и сохраняет форму
     */
    public function save()
    {
        $this->load(\Yii::$app->request->post());
        $this->files = UploadedFile::getInstances($this, 'files');

        if ($this->validate() && $this->files) {
            $this->files = $this->upload();
        }
    }
}