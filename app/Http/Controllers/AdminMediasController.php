<?php
namespace App\Http\Controllers;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;


class AdminMediasController extends Controller
{
    //
    

    public function index(){

        $photos = Photo::latest()->paginate(20);
        return view('media.index', compact('photos'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    public function create(){
        return view('media.create');
    }
    

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . '_' . $file->getClientOriginalName();
            
            // Garantir que a pasta existe
            $destinationPath = public_path('images/media/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $name);
            $photo = Photo::create(['file' => $name]);
            
            return response()->json(['id' => $photo->id, 'url' => asset('images/media/' . $name)]);
        }
        
        return response()->json(['error' => 'Nenhum arquivo enviado'], 400);
    }
    

    public function destroy($id){
            $photo = Photo::findOrFail($id);
            $photo->delete();
    }
    

    public function deleteMedia(Request $request){
        if(isset($request->delete_all) && !empty($request->checkBoxArray)){
            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){
                $photo->delete();
                unlink(public_path() .  '/images/media/' . $photo->file );
            }
            return redirect()->back()->with('user_success','Image/s deleted successfully!');;
        } else {
            return redirect()->back();
        }
    }




}
