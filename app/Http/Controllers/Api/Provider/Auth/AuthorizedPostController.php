<?php

namespace App\Http\Controllers\Api\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Views;
use App\Services\PostService;
use App\Traits\DefaultImage;
use Illuminate\Http\Request;
use Validator;
use function collect;
use function helperJson;

class AuthorizedPostController extends Controller
{
    use DefaultImage;

    private $post;

    //
    /*
     *  ===================== get all posts with images in home =======================================
     */
    /**
     * @param $post
     */
    public function __construct(PostService $post)
    {
        $this->post = $post;
    }

    public function userAds(Request $request)
    {
       return $this->post->userAds($request);
    }


// ===============================================================================
    public function add_ad(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'company_id' => 'nullable',
            'status' => 'required',
            'area_id' => 'required|numeric|exists:areas,id',
            'sub_area_id' => 'required|numeric|exists:sub_areas,id',
            'title_ar' => 'required|max:190',
            'title_en' => 'required|max:190',
            'title_ku' => 'required|max:190',
            'description_ar' => 'required|max:190',
            'description_en' => 'required|max:190',
            'description_ku' => 'required|max:190',
            'furniture' => 'required',
            'type' => 'required|max:190',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'currency' => 'required',
            'size' => 'required',
            'amenities' => 'nullable|array|min:1',
            'bedroom' => 'nullable',
            'bath_room' => 'required',
            'kitchen' => 'nullable|numeric',
            'living_room' => 'required|numeric',
            'dining_room' => 'nullable|numeric',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'location_name_ar' => 'nullable',
            'location_name_en' => 'nullable',
            'location_name_ku' => 'nullable',
            'images.*' => 'nullable|image',
            'videos.*' => 'nullable',
            'advertizer_name_ar' => "required",
            'advertizer_name_en' => "required",
            'advertizer_name_ku' => "required",
            'phone' => "required",
            'whatsapp' => "required",
        ], [
            'user_id.exists' => '404',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    '404' => 'failed,User Not Found',
                ];
                $code = collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 404, $code);
            }
//            return $this->final_response(collect($validator->errors())->flatten(1), 'failed', 422, 'yes');
            return helperJson(null, collect($validator->errors())->flatten(1), 422);

        }
        $inputs = $request->all();
        $main_image = null;

//        if ($request->main_image != '') {
//            $main_image = upload_image('products', $request->main_image, 1, 'main_image');
//        }

        /* add product info */
        $post = Post::create($inputs);

        /* add post images */
        if($request->images){
            foreach($request->images as $image){
                $post->images()->create([
                    'attachment' => $this->uploadFiles('post/images/',$image),
                    'type' => 'image'
                ]);
            }
        }

        /* add videos images */
        if($request->videos){
            foreach($request->videos as $video){
                $post->videos()->create([
                    'attachment' => $video,
                    'type' => 'video'
                ]);
            }
        }
        /* add videos images */
        if($request->amenities){
            foreach($request->amenities as $service){
                $post->services()->create([
                    'service_id' => $service
                ]);
            }
        }

        return helperJson($post, 'success');
    }
// ===============================================================================

// ===============================================================================
    public function view_ad(Request $request,$id)
    {
        $post = Post::find($id);

        $post->update(['views'=> ++$post->views]);
        return helperJson('successfully viewed', 'success');
    }
// ===============================================================================

    public function destroy($id)
    {
        return $this->post->destroy($id);
    }
// ===============================================================================

}
