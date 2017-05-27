<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Episode;

class EpisodeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $the_episode = new Episode();
        if ($request->hasFile('cover-episode')){
            $image = $request->file('cover-episode')->store('public');
            $image_file_name = explode('/', $image);
            $the_episode->cover = $image_file_name[1];
        }

        $the_episode->series_id = $id;
        $the_episode->episode = $request->episode;
        $the_episode->judul_episode = $request->judul_episode;
        $the_episode->spoiler = $request->spoiler;
        $the_episode->links = json_encode($request->episode_list);

        $the_episode->save();

        flash('Episode berhasil di tambahkan')->success();

        return redirect()->route('series.show', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $series_id, $episode_id)
    {
        $the_episode = Episode::find($episode_id);

        if ($request->hasFile('edit-episode-cover')){
            $image = $request->file('edit-episode-cover')->store('public');
            $image_file_name = explode('/', $image);
            $the_episode->cover = $image_file_name[1];
        }

        $the_episode->series_id = $series_id;
        $the_episode->episode = $request->episode;
        $the_episode->judul_episode = $request->judul_episode;
        $the_episode->spoiler = $request->spoiler;
        $the_episode->links = json_encode($request->episode_list);

        $the_episode->save();

        flash('Episode <strong>'.$the_episode->episode.'</strong> berhasil di update')->success();

        return redirect()->route('series.show', ['id' => $series_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $series_id
     * @param  int  $episode_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($series_id, $episode_id)
    {
        $the_episode = Episode::find($episode_id);
        $episode_ke = $the_episode->episode;

        $the_episode->delete();

        flash('Episode ke <strong>'.$episode_ke.'</strong> telah berhasil dihapus')->success();
        return redirect()->route('series.show', $series_id);
    }
}
