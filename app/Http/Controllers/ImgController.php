<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; 
use Log;

class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $size;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Log::notice($request->get('name'));
        $printName = $request->get('name');

        //文字列を1文字づつ配列にする。マルチバイトがないのであれば、str_splitでも可能
        $length = mb_strlen($printName,'UTF-8');
        $chunked = array();
        for ($i = 0; $i < $length; $i++) {
            $chunked[] = mb_substr($printName, $i, 1, 'UTF-8');
        }
        //配列を改行でjoin
        $verticalString = join("\n",$chunked);

        $path = storage_path('app/public/png.png');
        $img = Image::make($path);
        // $img->rotate(-45);

        $this->size = 35;
        $x = 73;
        $y = 43;
        if ($length === 1) {
            $this->size = 40;
            $x = 73;
            $y = 47;
        } elseif($length === 2) {
            $this->size = 43;
            $x = 71;
            $y = 26;
        } elseif($length === 3) {
            $this->size = 25;
            $x = 71;
            $y = 43;
        }
        // $img = Image::canvas(120, 60, '#000');
        $img->text($verticalString, $x, $y, function($font){
            $fontPath = storage_path('app/public/hkkaikk.ttf');
            $font->file($fontPath);
            $font->size($this->size);
            $font->color('#fc2414');
            $font->align('center');
            $font->valign('top');
            // $font->angle(30);
        });

        $save_path = storage_path('app/public/png1.png');
        $img->save($save_path);
        $tmpFileName = 'test';
        $downloadLink = asset('storage/png1.png');
        $returnArray = [
            'file_name' => $tmpFileName,
            'download_link' => $downloadLink,
        ];
        return response()->json($returnArray, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
