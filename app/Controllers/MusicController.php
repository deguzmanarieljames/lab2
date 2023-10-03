<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MusicController extends BaseController
{
    private $music;
    private $playlist;

    private $musicplaylist;

    public function __construct()
    {
        $this->music = new \App\Models\MusicModel();
        $this->playlist = new \App\Models\PlaylistModel();
        $this->musicplaylist = new \App\Models\MusicPlaylistModel();
    }

    public function index()
    {
        $data['playlists'] = $this->playlist->findAll();
        $data['music'] = $this->music->findAll();
        return view('music', $data);
    }
    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name')
        ];
        $this->playlist->insert($data);
        return redirect()->to('/mspl');
    }

    public function playlist($id)
    {
        $playlist = $this->playlist->find($id);
    
        if ($playlist) {
            $musicplaylist = $this->musicplaylist->where('playlist_id', $id)->findAll();
            $music = [];
            foreach ($musicplaylist as $track) {
                $musicItem = $this->music->find($track['music_id']);
                if ($musicItem) {
                    $music[] = $musicItem;
                }
            }
            $data = [
                'playlist' => $playlist,
                'music' => $music,
                'playlists' => $this->playlist->findAll(),
                'musicplaylist' => $musicplaylist,
            ];
    
            
    
            return view('music', $data);
        } else {
           return redirect()->to('/mspl');
        }
    }
    

    public function search()
    {
        $search = $this->request->getGet('title');
        $musicResults = $this->music->like('title', '%' . $search . '%')->findAll();
        $data = [
            'playlists' => $this->playlist->findAll(),
            'music' => $musicResults,
        ];
        return view('music', $data);
    }
    public function add()
    {

        $musicID = $this->request->getPost('musicID');
        $playlistID = $this->request->getPost('playlist');

        $data = [
            'playlist_id' => $playlistID,
            'music_id' => $musicID,
        ];
        $this->musicplaylist->insert($data);
        return redirect()->to('/mspl');
    }

    public function upload()
    {
        $file = $this->request->getFile('file');
        $title = $this->request->getPost('title');
        $artist = $this->request->getPost('artist');
        $newName = $title . '_' . $artist . '.' . 'mp3';
        $file->move(ROOTPATH . 'public/', $newName);
        $data = [
            'title' => $title,
            'artist' => $artist,
            'file_path' => $newName
        ];
        $this->music->insert($data);
        return redirect()->to('/mspl');
    }


}