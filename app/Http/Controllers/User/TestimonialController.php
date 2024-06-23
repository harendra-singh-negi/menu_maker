<?php

namespace App\Http\Controllers\User;

use App\Constants\Constant;
use App\Http\Helpers\Uploader;
use App\Models\User\Testimonial;
use App\Models\User\BasicExtended;
use App\Models\User\BasicSetting;
use App\Models\User\Language;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
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
        $data['abe'] = $lang->basic_extended;
        $data['testimonials'] = Testimonial::where([
            ['language_id', $data['lang_id']],
            ['user_id', $userId]
        ])->orderBy('id', 'DESC')->get();

        return view('user.home.testimonial.index', $data);
    }

    public function edit($id)
    {
        $userId = getRootUser()->id;
        $data['testimonial'] = Testimonial::query()
            ->where('user_id', $userId)
            ->find($id);
        $this->authorize('view', $data['testimonial']);    
        return view('user.home.testimonial.edit', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'user_language_id' => 'required',
            'comment' => 'required',
            'name' => 'required|max:50',
            'rank' => 'required|max:50',
            'rating' => 'required|min:1|max:5|numeric',
            'serial_number' => 'required|integer',
            'image' => ['required',new ImageMimeTypeRule()],
        ];

        $message = [
            'rating.required' => 'rating field is required',
            'rating.min' => 'min 1 and max 5 rating',
            'rating.max' => 'min 1 and max 5 rating',
            'user_language_id.required' => 'The language field is required'
        ];

        $validator = Validator::make($request->all(), $rules,$message);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $userId = getRootUser()->id;
        $input = $request->all();
        if ($request->hasFile('image')) {
            $input['image'] = Uploader::upload_picture(Constant::WEBSITE_TESTIMONIAL_IMAGES,$request->file('image'));
        }
        $input['user_id'] = $userId;
        $input['language_id'] = $request->user_language_id;
        $testimonial = new Testimonial;
        $testimonial->create($input);
        Session::flash('success', 'Testimonial added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $rules = [
            'comment' => 'required',
            'name' => 'required|max:50',
            'rank' => 'required|max:50',
            'rating' => 'required|min:1|max:5|numeric',
            'serial_number' => 'required|integer',
            'image' => new ImageMimeTypeRule()
        ];

        $message = [
            'rating.required' => 'rating field is required',
            'rating.min' => 'min 1 and max 5 rating',
            'rating.max' => 'min 1 and max 5 rating'
        ];

        $validator = Validator::make($request->all(), $rules,$message);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $userId = getRootUser()->id;
        $input = $request->all();
        $testimonial = Testimonial::query()
            ->where('user_id', $userId)
            ->findOrFail($request->testimonial_id);
        if ($request->hasFile('image')) {
            $input['image'] = Uploader::update_picture(Constant::WEBSITE_TESTIMONIAL_IMAGES,$request->file('image'),$testimonial->image);
        }
        $testimonial->update($input);
        Session::flash('success', 'Testimonial updated successfully!');
        return "success";
    }

    public function textUpdate(Request $request, $langid)
    {
       
        $userId = getRootUser()->id;
        $bs = BasicSetting::query()
            ->where([
                ['language_id', $langid],
                ['user_id', $userId]
            ])
            ->first();


        if ($request->hasFile('testimonial_bg_img')) {
            $be = BasicExtended::where([
                ['language_id', $langid],
                ['user_id', $userId]
            ])->first();
            $be->testimonial_bg_img = Uploader::update_picture(Constant::WEBSITE_TESTIMONIAL_IMAGES,$request->file('testimonial_bg_img'),$be->testimonial_bg_img);
            $be->save();
        }

        $bs->save();

        Session::flash('success', 'Text updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $userId = getRootUser()->id;
        $testimonial = Testimonial::query()
            ->where('user_id', $userId)
            ->findOrFail($request->testimonial_id);
        Uploader::remove(Constant::WEBSITE_TESTIMONIAL_IMAGES,$testimonial->image);
        $testimonial->delete();
        Session::flash('success', 'Testimonial deleted successfully!');
        return back();
    }
}
