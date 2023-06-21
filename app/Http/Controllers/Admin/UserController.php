<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\Service;
use App\Models\User;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Package Saved Images
     */
    use PhotoTrait;

    /**
     * this function return Users
     */
    // Index Start
    public function index(request $request)
    {
        if ($request->ajax()) {
            $user = User::latest()->where('role_id', 2)->get();
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    return '
                            <button type="button" data-id="' . $user->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $user->id . '" data-title="' . $user->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('balance', function ($user) {
                    if ($user->balance != null)
                        return $user->balance . ' نقطة ';
                    else
                        return '<span class="badge badge-danger">لا يوجد نقاط</span>';
                })
                ->editColumn('user_type', function ($user) {
                    if ($user->role_id == 1)
                        return '<span class="badge badge-info">مقدم خدمات</span>';
                    else
                        return '<span class="badge badge-info">عميل</span>';
                })
                ->editColumn('email', function ($user) {
                    if(isset($user->email)){
                        return '<a href="mailto:' . $user->email . '">' . $user->email . '</a>';
                    }
                    else {
                        return '<td>غير موجود</td>';
                    }
                })
                ->addColumn('rate', function ($user) {
                    $rate = round(Rate::where('provider_id', $user->id)->avg('value'), 1);
                    $stars = "";
                    for ($i = 1; $i < 6; $i++) {
                        if ($rate > $i) {
                            $stars .= ' <span class="fa fa-star checked"></span>';
                        } else {
                            $stars .= ' <span class="fa fa-star"></span>';
                        }
                    }
                    return $stars;
                })

                ->editColumn('image', function ($user) {
                    $image = ($user->image);
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . $image . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin/user/index');
        }
    }
    // Index End

    /**
     * this function return Providers Restaurant
     */
    // Restaurant Start
    public function restaurantProvider(request $request)
    {
        if ($request->ajax()) {
            $user = User::latest()->where('role_id', 1)->where('provider_type', 1)->get();
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    return '
                            <button type="button" data-id="' . $user->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $user->id . '" data-title="' . $user->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('balance', function ($user) {
                    if ($user->balance != null)
                        return $user->balance . ' نقطة ';
                    else
                        return '<span class="badge badge-danger">لا يوجد نقاط</span>';
                })
                ->editColumn('in_service', function ($user) {
                        return '<select class="form-control" data-id="' . $user->id . '" onchange="updateRequestStatus(this, ' . $user->id . ')">
                        <option ' . ($user->status == 1 ? "selected" : "") . ' value="1" style="text-align: center">نعم</option>
                        <option ' . ($user->status == 0 ? "selected" : "") . ' value="0" style="text-align: center">لا</option>
                        </select>';
                })
                ->editColumn('user_type', function ($user) {
                    if ($user->role_id == 1)
                        return '<span class="badge badge-info">مقدم خدمات</span>';
                    else
                        return '<span class="badge badge-info">عميل</span>';
                })
                ->editColumn('email', function ($user) {
                    if(isset($user->email)){
                        return '<a href="mailto:' . $user->email . '">' . $user->email . '</a>';
                    }
                    else {
                        return '<td>غير موجود</td>';
                    }
                })
                ->addColumn('rate', function ($user) {
                    $rate = round(Rate::where('provider_id', $user->id)->avg('value'), 1);
                    $stars = "";
                    for ($i = 1; $i < 6; $i++) {
                        if ($rate > $i) {
                            $stars .= ' <span class="fa fa-star checked"></span>';
                        } else {
                            $stars .= ' <span class="fa fa-star"></span>';
                        }
                    }
                    return $stars;
                })

                ->editColumn('image', function ($user) {
                    $image = ($user->image);
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . $image . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin.user.restaurant_provider');
        }
    }

    // Restaurant End

    /**
     * this function return Coffee Providers
     */
     // Coffee Provider Start
    public function coffeeProvider(request $request)
    {
        if ($request->ajax()) {
            $user = User::latest()->where('role_id', 1)->where('provider_type', 2)->get();
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    return '
                            <button type="button" data-id="' . $user->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $user->id . '" data-title="' . $user->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('balance', function ($user) {
                    if ($user->balance != null)
                        return $user->balance . ' نقطة ';
                    else
                        return '<span class="badge badge-danger">لا يوجد نقاط</span>';
                })
                ->editColumn('user_type', function ($user) {
                    if ($user->role_id == 1)
                        return '<span class="badge badge-info">مقدم خدمات</span>';
                    else
                        return '<span class="badge badge-info">عميل</span>';
                })
                ->editColumn('in_service', function ($user) {
                    return '<select class="form-control" data-id="' . $user->id . '" onchange="updateRequestStatus(this, ' . $user->id . ')">
                    <option ' . ($user->status == 1 ? "selected" : "") . ' value="1" style="text-align: center">نعم</option>
                    <option ' . ($user->status == 0 ? "selected" : "") . ' value="0" style="text-align: center">لا</option>
                    </select>';
            })
                ->editColumn('email', function ($user) {
                    if(isset($user->email)){
                        return '<a href="mailto:' . $user->email . '">' . $user->email . '</a>';
                    }
                    else {
                        return '<td>غير موجود</td>';
                    }
                })
                ->addColumn('rate', function ($user) {
                    $rate = round(Rate::where('provider_id', $user->id)->avg('value'), 1);
                    $stars = "";
                    for ($i = 1; $i < 6; $i++) {
                        if ($rate > $i) {
                            $stars .= ' <span class="fa fa-star checked"></span>';
                        } else {
                            $stars .= ' <span class="fa fa-star"></span>';
                        }
                    }
                    return $stars;
                })

                ->editColumn('image', function ($user) {
                    $image = ($user->image);
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . $image . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin.user.coffee_provider');
        }
    }
    // Coffee Provider End


    public function create()
    {
        return view('Admin.user.parts.create');
    }


    public function store(Request $request)
    {
        $valiadate = $request->validate([
            'name'     => 'required',
            'password' => 'required|min:6',
        ], [
            'user_name.required' => 'يرجي ادخال اسم المستخدم'
        ]);
        $data = $request->except('_token', 'image');
        if ($request->has('image') && $request->image != null)
            $data['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'image', '100');

        $data['password'] = Hash::make($request->password);
        User::create($data);
        return response()->json(['status' => 200]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('Admin.user.parts.edit', compact('user'));
    }



    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 404]);
        }

        $data = $request->except('_token', '_method', 'image');

        if ($request->has('password') && $request->password != null)
            $data['password'] = Hash::make($request->password);
        else
            unset($data['password']);

        if ($request->has('image') && $request->image != null) {
            if (file_exists($user->getAttributes()['image'])) {
                unlink($user->getAttributes()['image']);
            }
            $data['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'photo');
        }

        // dd($data)
        User::where('id', $user->id)->update($data);
        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function RequestStatusDegree(Request $request)
    {
        $inputs = User::find($request->id)->update([
            'status' => $request->status,
        ]);

        return response()->json(['code' => 200, 'status' => $request->status]);
    }

    public function delete(request $request)
    {
        $user = User::findOrFail($request->id);
        if (file_exists($user->getAttributes()['image'])) {
            unlink($user->getAttributes()['image']);
        }
        $user->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
