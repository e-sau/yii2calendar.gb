<?php


namespace app\commands;


use app\models\Activity;
use yii\console\Controller;

class MailController extends Controller
{
    public function actionSendMail($email = null)
    {
        $userActivities = $this->getUserActivities($email);

        foreach ($userActivities as $id => $user) {
            $result = \Yii::$app->mailer->compose([
                'html' => 'user_notify'], [
                'items' => $user['activities']
            ])
                ->setFrom('noreply@calendar.ru')
                ->setTo($user['email'])
                ->setSubject('Ваши планы на сегодня')
                ->send();
            if (!$result) {
                echo 'Ошибка. Письмо пользователю с #id=' . $id . 'не отправлено';
            }
        }
    }

    protected function getUserActivities($email = null)
    {
        /** @var Activity $activity */
        $userActivities = [];

        if (!is_null($email)) {
            $activities = Activity::find()
                ->joinWith('user')
                ->andWhere(['user.email' => $email])->all();

            foreach ($activities as $activity) {
                $userActivities[$activity->user->id]['activities'][] = [
                    'id' => $activity->id,
                    'title' => $activity->title
                ];
            }
            return $userActivities;
        }

        $activities = Activity::find()
            ->andWhere([
                "<=", "FROM_UNIXTIME(started_at, '%Y-%m-%d')", date('Y-m-d')
            ])
            ->andWhere([
                '>=', "FROM_UNIXTIME(finished_at, '%Y-%m-%d')", date('Y-m-d')
            ])->all();

        foreach ($activities as $activity) {
            if (!isset($userActivities[$activity->user->id])) {
                $userActivities[$activity->user->id]['email'] = $activity->user->email;
            }
            $userActivities[$activity->user->id]['activities'][] = [
                'id' => $activity->id,
                'title' => $activity->title
            ];
        }
        return $userActivities;
    }
}