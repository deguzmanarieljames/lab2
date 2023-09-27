<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MusicController extends BaseController
{
    private $musics;
    private $playlists;
    public function __construct()
    {
        $this->musics = new \App\Models\MusicModel();
        $this->playlists = new \App\Models\PlaylistModel();
    }

    public function index()
    {
        //
    }

    public function mspl($playlists)
    {
        $data['musics'] = $this->musics->findAll();
        $data['playlists'] = $this->playlists->findAll();
        return view('music', $data);
    }

    public function save()
    {
        if ($file = $this->request->getFile('audio')){
            $destination = './mspl';
            $file->move($destination);
            $audioFileName = $file->getName();
            $newAudio = [
                'audio' => $audioFileName,
            ];
            return redirect()->to('/music');
        }



        $id = $_POST('id');
        $data = [
            'audio' => $this->request->getVar('audio'),
        ];
        if($id != null){
            $this->musics->set($data)->where('id', $id)->update();
        }else{
            $this->musics->save($data);
        }  
        return redirect()->to('/mspl');
    }
    public function psave()
    {
        $data = [
            'playlist' => $this->request->getVar('playlist')
        ];

            $this->playlists->save($data);

        return redirect()->to('#exampleModal');
    }
    public function delete(){
        $this->musics->delete();
        return redirect()->to('/mspl');
    }
    public function pdelete(){
        $this->playlists->delete();
        return redirect()->to('/mspl');
    }


}