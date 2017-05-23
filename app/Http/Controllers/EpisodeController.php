<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $series = new Episode();
        $file = $request->file('cover-episode');
        $image_name = create_slug($request->judul_episode) . '.jpg';
        $file->move('images/'.$id, $image_name); //dipindahkan kdealam folder (images/series_id)

        $series->series_id = $id;
        $series->cover = $id . '/' . $image_name;
        $series->episode = $request->episode;
        $series->judul_episode = $request->judul_episode;
        $series->spoiler = $request->spoiler;
        $series->links = json_encode($request->episode_list);

        $series->save();

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
        $the_episode = Episodes::find($episode_id);

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
