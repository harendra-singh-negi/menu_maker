<?php

namespace App\Http\Controllers\User;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Uploader;
use App\Models\User\BasicExtended;
use App\Models\User\Language;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HerosectionController extends Controller
{
    public function imgText(Request $request)
    {
        $userId = getRootUser()->id;
        $lang = Language::where([
            ['code', $request->language],
            ['user_id', $userId]
        ])->first();
        $data['lang_id'] = $lang->id;
        $data['abe'] = $lang->basic_extended;
        return view('user.home.hero.img-text', $data);
    }

    public function update(Request $request, $langid)
    {
        $rules = [
            'hero_image' => new ImageMimeTypeRule(),
            'side_image' => new ImageMimeTypeRule(),
            'shape_image' => new ImageMimeTypeRule(),
            'bottom_image' => new ImageMimeTypeRule(),

            'hero_section_bold_text' => 'nullable|max:255',
            'hero_section_bold_text_font_size' => 'required|numeric|digits_between:1,3',
            'hero_section_bold_text_color' => 'nullable|max:20',

            'hero_section_text' => 'nullable|max:255',
            'hero_section_text_font_size' => 'required|numeric|digits_between:1,3',
            'hero_section_text_color' => 'nullable|max:20',

            'hero_section_button_text' => 'nullable|max:30',
            'hero_section_button_text_font_size' => 'required|numeric|digits_between:1,3',
            'hero_section_button_color' => 'nullable|max:20',
            'hero_section_button_url' => 'nullable',

            'hero_section_button2_text' => 'nullable|max:30',
            'hero_section_button2_text_font_size' => 'required|numeric|digits_between:1,3',
            'hero_section_button2_url' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $userId = getRootUser()->id;
        $be = BasicExtended::query()->where([
            ['language_id', $langid],
            ['user_id', $userId]
        ])->first();

        $be->hero_section_bold_text = $request->hero_section_bold_text;
        $be->hero_section_bold_text_font_size = $request->hero_section_bold_text_font_size;
        $be->hero_section_bold_text_color = $request->hero_section_bold_text_color;

        $be->hero_section_text = $request->hero_section_text;
        $be->hero_section_text_font_size = $request->hero_section_text_font_size;
        $be->hero_section_text_color = $request->hero_section_text_color;

        $be->hero_section_button_text = $request->hero_section_button_text;
        $be->hero_section_button_text_font_size = $request->hero_section_button_text_font_size;
        $be->hero_section_button_color = $request->hero_section_button_color;
        $be->hero_section_button_url = $request->hero_section_button_url;

        $be->hero_section_button2_text = $request->hero_section_button2_text;
        $be->hero_section_button2_text_font_size = $request->hero_section_button2_text_font_size;
        $be->hero_section_button2_url = $request->hero_section_button2_url;

        if ($request->hasFile('hero_image')) {
            $be->hero_bg = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('hero_image'),$be->hero_bg);
        }
        if ($request->hasFile('side_image')) {
            $be->hero_side_img = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('side_image'),$be->hero_side_img);
        }
        if ($request->hasFile('shape_image')) {
            $be->hero_shape_img = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('shape_image'),$be->hero_shape_img);
        }
        if ($request->hasFile('bottom_image')) {
            $be->hero_bottom_img = Uploader::update_picture(Constant::WEBSITE_IMAGE,$request->file('bottom_image'),$be->hero_bottom_img);
        }
        $be->save();
        Session::flash('success', 'Hero Section updated successfully!');
        return "success";
    }

    public function removeImage(Request $request) 
    {
        $lang = Language::where('code', $request->language_id)->where('user_id', Auth::guard('web')->user()->id)->first();

        $type = $request->type;
        $langid = $lang->id;
        $userId = getRootUser()->id;
        $be = BasicExtended::query()
            ->where([
                ['language_id', $langid],
                ['user_id', $userId]
            ])
            ->first();

        if ($type == "background") {
            Uploader::remove(Constant::WEBSITE_IMAGE,$be->hero_bg);
            $be->hero_bg = NULL;
            $be->save();
        }

        if ($type == "side") {
            Uploader::remove(Constant::WEBSITE_IMAGE,$be->hero_side_img);
            $be->hero_side_img = NULL;
            $be->save();
        }

        if ($type == "shape") {
            Uploader::remove(Constant::WEBSITE_IMAGE,$be->hero_shape_img);
            $be->hero_shape_img = NULL;
            $be->save();
        }

        if ($type == "bottom") {
            Uploader::remove(Constant::WEBSITE_IMAGE,$be->hero_bottom_img);
            $be->hero_bottom_img = NULL;
            $be->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }

    public function video()
    {
        $userId = getRootUser()->id;
        $data['abe'] = BasicExtended::query()
                       ->where('user_id', $userId)
                       ->first();
        return view('user.home.hero.video', $data);
    }

    public function videoupdate(Request $request)
    {
        $rules = [
            'video_link' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $userId = getRootUser()->id;
        $bes = BasicExtended::query()
            ->where('user_id', $userId)
            ->get();

        $videoLink = $request->video_link;
        if (strpos($videoLink, "&")) {
            $videoLink = substr($videoLink, 0, strpos($videoLink, "&"));
        }

        foreach ($bes as $be) {
            # code...
            $be->hero_section_video_link = $videoLink;
            $be->save();
        }
        Session::flash('success', 'Informations updated successfully!');
        return "success";
    }
}
