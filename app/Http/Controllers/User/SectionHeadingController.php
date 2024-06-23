<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User\Language;
use App\Http\Controllers\Controller;
use App\Models\User\UserSectionHeading;
use Illuminate\Support\Facades\Session;

class SectionHeadingController extends Controller
{
    public function sectionHeading(Request $request)
    {
       
        $userId = getRootUser()->id;
        $lang = Language::where([
            ['code', $request->language],
            ['user_id', $userId]
        ])->first();

        $sectionHeadings = UserSectionHeading::query()
            ->where([
                ['language_id', $lang->id],
                ['user_id', $userId]
            ])->first();

        $data['lang_id'] = $lang->id;
        $data['sectionHeadings'] = $sectionHeadings;

        return view('user.section_headings', $data);
    }

    public function updateSectionHeading(Request $request, $langid)
    {
        $userId = getRootUser()->id;

        $sectionHeading = UserSectionHeading::query()
            ->where([
                ['language_id', $langid],
                ['user_id', $userId]
            ])->first();
        $sectionHeading->menu_title = $request->menu_title;
        $sectionHeading->menu_subtitle = $request->menu_subtitle;
        $sectionHeading->team_title = $request->team_title;
        $sectionHeading->team_subtitle = $request->team_subtitle;
        $sectionHeading->blog_title = $request->blog_title;
        $sectionHeading->blog_subtitle = $request->blog_subtitle;
        $sectionHeading->testimonial_title = $request->testimonial_title;
      
        $sectionHeading->save();

        Session::flash('success', 'Section heading updated successfully!');
        return back();
    }
}
