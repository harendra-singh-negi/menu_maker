<?php

namespace App\Http\Controllers\User;

use App\Constants\Constant;
use App\Http\Helpers\Uploader;
use App\Models\User\BasicSetting;
use App\Models\User\Language;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class IntrosectionController extends Controller
{
    public function index(Request $request)
    {
        $userId = getRootUser()->id;
        $lang = Language::where([
            ['code', $request->language],
            ['user_id', $userId]
        ])->first();
        
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        
        return view('user.home.intro-section', $data);
    }

    public function update(Request $request, $langid)
    {
        $rules = [
            'intro_title' => 'required',
            'intro_text' => 'required',
            'intro_main_image' => new ImageMimeTypeRule(),
            'intro_signature' => new ImageMimeTypeRule(),
            'intro_video_image' => new ImageMimeTypeRule(),
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $userId = getRootUser()->id;
        $input = $request->all();
        $bs = BasicSetting::where([
            ['language_id', $langid],
            ['user_id', $userId]
        ])->first();
        if ($request->hasFile('intro_main_image')) {
            $input['intro_main_image'] = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('intro_main_image'),$bs->intro_main_image);
        }
        if ($request->hasFile('intro_signature')) {
            $input['intro_signature'] = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('intro_signature'),$bs->intro_signature);
        }
        if ($request->hasFile('intro_video_image')) {
            $input['intro_video_image'] = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('intro_video_image'),$bs->intro_video_image);
        }
        $bs->update($input);
        Session::flash('success', 'data updated successfully!');
        return "success";
    }

    public function removeImage(Request $request) 
    {
        $lang = Language::where('code', $request->language_id)->where('user_id', Auth::guard('web')->user()->id)->first();
        $userId = getRootUser()->id;
        $bs = BasicSetting::where([
            ['language_id', $lang->id],
            ['user_id', $userId]
        ])->first();
        if ($request->type == "signature") {
            Uploader::remove(Constant::WEBSITE_IMAGE,$bs->intro_signature);
            $bs->intro_signature = NULL;
            $bs->save();
        }
        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
