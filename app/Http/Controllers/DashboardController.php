<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest; 
use App\Http\Requests\UserEditRequest; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Member;
use App\Models\Client;
use App\Models\Photo;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
    	$post_number       = Post::count();
    	$project_number    = Project::count();
    	$service_number    = Service::count();
    	$testimonial_number = Testimonial::count();
    	$member_number     = Member::count();
    	$client_number     = Client::count();
        $media_number      = Photo::count();
        $user_number       = User::count();

        return view('dashboard.index', compact(
            'post_number', 'project_number', 'service_number',
            'testimonial_number', 'member_number', 'client_number',
            'media_number', 'user_number'
        ));
    }

    /**
     * Retorna total de visitas de hoje (usando sessions como proxy leve).
     * Quando o sistema de PageViews for implementado, este método retornará dados reais.
     */
    public function visitsToday(Request $request)
    {
        // Proxy leve: conta arquivos de sessão criados hoje
        $sessionPath = storage_path('framework/sessions');
        $count = 0;
        if (File::exists($sessionPath)) {
            $today = now()->startOfDay()->timestamp;
            $files = File::files($sessionPath);
            foreach ($files as $file) {
                if ($file->getMTime() >= $today) {
                    $count++;
                }
            }
        }
        return response()->json(['count' => $count, 'date' => now()->format('d/m/Y')]);
    }
}
