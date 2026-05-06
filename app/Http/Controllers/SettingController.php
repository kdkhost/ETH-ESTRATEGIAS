<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Language;

class SettingController extends Controller
{
    //

    public function edit(Request $request)
    {
        $langs = Language::all();
        if (empty($request->language)) {
            $data['lang_id'] = 0;
            $data['setting'] = Setting::firstOrFail();
        } else {
            $lang = Language::where('code', $request->language)->firstOrFail();
            $data['lang_id'] = $lang->id;
            $data['setting'] = Setting::findOrFail($lang->id);
        }


        return view('settings.edit', $data, compact('langs'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting, $langid)
    {

        $setting = Setting::where('language_id', $langid)->firstOrFail();
        
        $input = $request->all();

        $this->validate($request, [

            'photo_id' => 'mimes:jpg,jpeg,png,webp,gif,svg']

        );

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $setting->update($input);

        return back()->with('setting_success','Settings updated successfully!');
    }



    public function optimize(Request $request)
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('optimize:clear');
            \Illuminate\Support\Facades\Artisan::call('config:cache');
            \Illuminate\Support\Facades\Artisan::call('route:cache');
            \Illuminate\Support\Facades\Artisan::call('view:cache');

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Sistema otimizado com sucesso!']);
            }
            return back()->with('setting_success', 'Sistema otimizado com sucesso! (Caches gerados)');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('setting_error', 'Erro ao otimizar: ' . $e->getMessage());
        }
    }
}
