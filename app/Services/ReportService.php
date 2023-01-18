<?php

namespace App\Services;

use App\Models\Report;
use App\Traits\DefaultImage;
use App\Traits\FirebaseNotification;
use Symfony\Component\HttpFoundation\Response;

class ReportService
{
    use DefaultImage,FirebaseNotification;

    public function store($request){
        try {
            $inputs = $request->all();
            $user = Auth()->user();
            $inputs['user_id'] = $user->id;
            if($request->image) {
                $inputs['image'] = $this->uploadFiles('reports/', $request->image);
            }
            $report = Report::create($inputs);
            if(isset($inputs['post_id'])){
                $data['title'] = 'إشعار بلاغات';
                $data['body'] = 'لقد تم الإبلاغ عن اعلانك رقم '. $report->post->id;
                $this->sendBasicNotification([$report->post->user_id],$data);
            }
            if(isset($inputs['project_id'])){
                $data['title'] = 'إشعار بلاغات';
                $data['body'] = 'لقد تم الإبلاغ عن اعلانك رقم '. $report->project->id;
                $this->sendBasicNotification([$report->project->user_id],$data);
            }
            return helperJson($report, 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
