<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::paginate(config('app.paginate'));

        return view('admin.videos.index', [
            'videos' => $videos
        ]);
    }



}
