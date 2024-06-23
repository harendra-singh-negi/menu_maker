<?php

namespace App\Http\Controllers\User;

use App\Constants\Constant;
use App\Http\Helpers\Uploader;
use App\Models\User\Feature;
use App\Models\User\Language;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $userId = getRootUser()->id;
        $lang = Language::where([
            ['code', $request->language],
            ['user_id', $userId]
        ])->first();
        $this->authorize('view',$lang);
        $lang_id = $lang->id;
        $data['features'] = Feature::query()->where([
            ['language_id', $lang_id],
            ['user_id', $userId]
        ])
        ->orderBy('id', 'DESC')
        ->get();
        $data['lang_id'] = $lang_id;
        return view('user.home.feature.index', $data);
    }

    public function edit($id)
    {
        $userId = getRootUser()->id;
        $data['feature'] = Feature::query()
            ->where('user_id', $userId)
            ->find($id);
        $this->authorize('view', $data['feature'])  ;  
        return view('user.home.feature.edit', $data);
    }

    public function store(Request $request)
    {
        $messages = [
            'user_language_id.required' => 'The language field is required'
        ];

        $rules = [
            'user_language_id' => 'required',
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',
            'image' => [
                'required',
                new ImageMimeTypeRule()
            ]
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        if ($request->hasFile('image')) {
            $image = Uploader::upload_picture(Constant::WEBSITE_FEATURE_IMAGES,$request->file('image'));
        }else{
            $image = null;
        }
        $userId = getRootUser()->id;
        $feature = new Feature;
        $feature->image = $image;
        $feature->language_id = $request->user_language_id;
        $feature->title = $request->title;
        $feature->serial_number = $request->serial_number;
        $feature->user_id = $userId;
        $feature->save();

        Session::flash('success', 'Feature added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $rules = [
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',
            'image' => new ImageMimeTypeRule(),
        ];

        $request->validate($rules);
        $userId = getRootUser()->id;
        $feature = Feature::query()
            ->where('user_id', $userId)
            ->findOrFail($request->feature_id);

        if ($request->hasFile('image')) {
            $feature->image = Uploader::update_picture(Constant::WEBSITE_FEATURE_IMAGES,$request->file('image'),$feature->image);
        }
        $feature->title = $request->title;
        $feature->serial_number = $request->serial_number;
        $feature->save();

        Session::flash('success', 'Feature updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $userId = getRootUser()->id;
        $feature = Feature::query()
            ->where('user_id', $userId)
            ->findOrFail($request->feature_id);
        Uploader::remove(Constant::WEBSITE_FEATURE_IMAGES,$feature->image);
        $feature->delete();

        Session::flash('success', 'Feature deleted successfully!');
        return back();
    }

    public function removeImage(Request $request) {
       
        $lang = Language::where('code', $request->language_id)->where('user_id', Auth::guard('web')->user()->id)->first();
        $type = $request->type;
        $featId = $request->feature_id;
        $userId = getRootUser()->id;
        $feature = Feature::query()
            ->where('user_id', $userId)->where('language_id', $lang->id)
            ->findOrFail($featId);
            

        if ($type == "feature") {
            Uploader::remove(Constant::WEBSITE_FEATURE_IMAGES,$feature->image);
            $feature->image = NULL;
            $feature->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
