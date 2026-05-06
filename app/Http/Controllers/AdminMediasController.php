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
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            $destinationPath = public_path('images/media/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $name);
            $photo = Photo::create(['file' => $name]);
            
            return response()->json([
                'id' => $photo->id, 
                'name' => $name,
                'url' => asset('images/media/' . $name),
                'success' => true
            ]);
        }
        
        return response()->json(['error' => 'Nenhum arquivo enviado ou inválido'], 400);
    }
    

    public function destroy($id){
        $photo = Photo::findOrFail($id);
        $filePath = public_path('images/media/' . $photo->file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $photo->delete();
        return back()->with('user_success', 'Imagem excluída com sucesso!');
    }
    

    public function deleteMedia(Request $request){
        if(isset($request->delete_all) && !empty($request->checkbox_array)){
            $photos = Photo::findOrFail($request->checkbox_array);
            foreach($photos as $photo){
                $filePath = public_path('images/media/' . $photo->file);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $photo->delete();
            }
            return redirect()->back()->with('user_success','Imagens excluídas com sucesso!');
        } else {
            return redirect()->back();
        }
    }




}
