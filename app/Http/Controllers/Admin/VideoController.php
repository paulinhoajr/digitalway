<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoStoreRequest;
use App\Http\Requests\Admin\VideoUpdateRequest;
use App\Models\Video;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request): View
    {

        $keyword = $request->get('search');

        if (!empty($keyword)) {

            $videos = Video::where(function ($query) use ($keyword) {
                    $query->where('nome', 'LIKE', "%$keyword%")
                        ->orWhere('descricao', 'LIKE', "%$keyword%");
                })->latest()->paginate(config('app.paginate'));

        } else {
            $videos = Video::latest()->paginate(config('app.paginate'));
        }
        return view('admin.videos.index', [
            'videos' => $videos
        ]);
    }

    public function create(): View
    {

        return view('admin.videos.create');
    }

    public function store(VideoStoreRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $video = new Video();
            $video->nome = $request->nome;
            $video->cidade_id = $request->cidade_id ?? null;
            $video->escola_id = $request->escola_id ?? null;
            $video->descricao = $request->descricao;
            $video->url = $request->url;
            $video->situacao = $request->situacao;
            $video->save();

            DB::commit();

            return redirect()
                ->route('admin.videos.edit', ['id'=>$video->id])
                ->with('message', 'Video inserido com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }

    }

    public function edit($id): View
    {
        $video = Video::where('id', $id)
            ->first();

        return view('admin.videos.edit', [
            'video' => $video
        ]);
    }

    public function update(VideoUpdateRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $video = Video::where('id', $request->id)
                ->first();

            $video->nome = $request->nome;
            $video->cidade_id = $request->cidade_id ?? null;
            $video->escola_id = $request->escola_id ?? null;
            $video->descricao = $request->descricao;
            $video->url = $request->url;
            $video->situacao = $request->situacao;
            $video->save();

            DB::commit();

            return redirect()
                ->route('admin.videos.edit', ['id'=>$video->id])
                ->with('message', 'Video alterado com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
    }

    public function delete($id): View
    {
        $video = Video::where('id', $id)
            ->first();

        return view('admin.videos.delete', [
            'video' => $video
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $video = Video::where('id', $id)
            ->first();

        if ($video){
            $video->delete();

            return redirect()
                ->route('admin.videos.index')
                ->with('message', 'Video excluído com sucesso.');
        }

        return back()->with('message_fail', 'O Video não pode ser excluído.');

    }

}
