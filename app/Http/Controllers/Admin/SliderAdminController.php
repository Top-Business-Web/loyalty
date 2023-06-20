<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\PhotoTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SliderAdminController extends Controller
{
    use PhotoTrait;
    public function index(request $request)
    {
        if ($request->ajax()) {
            $sliders = Slider::latest()->where('type', 'restaurant')->get();
            return Datatables::of($sliders)
                ->addColumn('action', function ($sliders) {
                    return '
                            <button type="button" data-id="' . $sliders->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $sliders->id . '" data-title="#' . $sliders->id . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('image', function ($sliders) {
                    return '
                    <img alt="Slider" onclick="window.open(this.src)" style="cursor:pointer" class="avatar avatar-lg bradius cover-image" src="' . $sliders->image . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin.sliders.restaurant');
        }
    }

    public function coffee(request $request)
    {
        if ($request->ajax()) {
            $sliders = Slider::latest()->where('type', 'coffee')->get();
            return Datatables::of($sliders)
                ->addColumn('action', function ($sliders) {
                    return '
                            <button type="button" data-id="' . $sliders->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $sliders->id . '" data-title="#' . $sliders->id . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('image', function ($sliders) {
                    return '
                    <img alt="Slider" onclick="window.open(this.src)" style="cursor:pointer" class="avatar avatar-lg bradius cover-image" src="' . $sliders->image . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin.sliders.coffee');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('Admin/sliders.parts.create');
    }

    public function store(request $request)
    {
        $inputs = $request->validate([
            'image'         => 'required|mimes:jpeg,jpg,png,gif,svg,jfif',
            //            'link'          => 'required|url',
            'type' => 'required'
        ], [
            'link.url'  => 'يرجي ادخال رابط صحيح يبدأ ب http'
        ]);
        if ($request->has('image'))
            $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/sliders', 'no');

        if (Slider::create($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }

    public function edit(Slider $slider)
    {
        return view('Admin/sliders.parts.edit', compact('slider'));
    }



    public function show($id)
    {
        //
    }

    public function update(request $request, $id)
    {
        $inputs = $request->validate([
            'image'         => 'nullable|mimes:jpeg,jpg,png,gif,svg',
            //            'link'          => 'required|url',
            'type' => 'required',
        ]);
        $slider = Slider::findOrFail($id);
        if ($request->has('image')) {
            if (file_exists($slider->image)) {
                unlink($slider->image);
            }
            $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/sliders', 'no');
        }
        if ($slider->update($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }


    public function destroy($id)
    {
        //
    }
    public function delete(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        if (file_exists($slider->getAttributes()['image'])) {
            unlink($slider->getAttributes()['image']);
        }
        $slider->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }

}
