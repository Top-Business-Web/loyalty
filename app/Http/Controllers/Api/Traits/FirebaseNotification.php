<?php

namespace App\Http\Controllers\Api\Traits;

use App\Models\FirebaseToken;
use App\Models\Notification;
use App\Models\User;

trait FirebaseNotification{

    //firebase server key
    private $serverKey = 'AAAAvcvsG5E:APA91bHXIApfxcgUYwNQohgWbydXAOTcjSr5dWzQpT5HnID-v0GN3HuxahdId2DG4saeoNHu7tSFdL3h9AOwH_p8HOst0IQNPKkbCMycBgI7ZkaB5XWpQdN3bmOAFItqdTNVMh8EJgKH';

    public function sendFirebaseNotification($data,$client_id = null,$provider_id = null){

        $url = 'https://fcm.googleapis.com/fcm/send';

        if($client_id != null){
            $userIds = User::query()->where('id','=',$client_id)->pluck('id')->toArray();
            $tokens = FirebaseToken::query()->whereIn('client_id',$userIds)->pluck('phone_token')->toArray();
        }else{
            $usersIds = User::query()->where('id','=',$provider_id)->pluck('id')->toArray();
            $tokens = FirebaseToken::query()->whereIn('client_id',$usersIds)->pluck('phone_token')->toArray();
        }

        Notification::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'client_id' => $client_id ?? null,
            'provider_id' => $provider_id ?? null,
        ]);

        $fields = array(
            'registration_ids' => $tokens,
            'data' => $data,
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}
