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
        // $printName = utf8_encode($printName);

        //文字列を1文字づつ配列にする。マルチバイトがないのであれば、str_splitでも可能
        $length = mb_strlen($printName,'UTF-8');
        $chunked = array();
        for ($i = 0; $i < $length; $i++) {
            $chunked[] = mb_substr($printName, $i, 1, 'UTF-8');
        }
        Log::info($chunked);
        //配列を改行でjoin
        $verticalString = join("\n",$chunked);

        $path = storage_path('app/public/png.png');
        $img = Image::make($path);
        // $img->rotate(-45);

        $this->size = 35;
        $x = 73;
        $y = 43;
        $adjustX = 0;
        $adjustY = 0;
        if ($length === 1) {
            $this->size = 53;
            $x = 72;
            $y = 43;
        } elseif($length === 2) {
            $this->size = 39;
            $x = 71;
            $y = 30;
            $adjustX = 1;
            $adjustY = 40;
        } elseif($length === 3) {
            $this->size = 30;
            $x = 71;
            $y = 26;
            $adjustX = 0;
            $adjustY = 30;
        } elseif($length === 4) {
            $this->size = 37;
            $x = 89;
            $y = 35;
            $adjustXY = [
                [0, 0],
                [0, 32],
                [-36, -32],
                [0, 32],
            ];
        } elseif($length === 5) {
            $this->size = 37;
            $x = 86;
            $y = 29;
            $adjustXYSize = [
                [0, 0, 28],
                [0, 26, 28],
                [0, 26, 28],
                [-34, -50, 30],
                [0, 32, 30],
            ];
        }

        if ($length <= 3) {            
            foreach ($chunked as $char) {
                $img->text($char, $x, $y, function($font){
                    $fontPath = storage_path('app/public/SourceHanSerif-Heavy.otf');
                    $font->file($fontPath);
                    $font->size($this->size);
                    $font->color('#fc2414');
                    $font->align('center');
                    $font->valign('top');
                });
                $x += $adjustX;
                $y += $adjustY;
            }
        } elseif($length === 4) {
            $index = 0;
            foreach ($chunked as $char) {
                $x += $adjustXY[$index][0];
                $y += $adjustXY[$index][1];
                $img->text($char, $x, $y, function($font){
                    $fontPath = storage_path('app/public/SourceHanSerif-Heavy.otf');
                    $font->file($fontPath);
                    $font->size($this->size);
                    $font->color('#fc2414');
                    $font->align('center');
                    $font->valign('top');
                });
                $index++;
            }
        } elseif($length === 5) {
            $index = 0;
            foreach ($chunked as $char) {
                $x += $adjustXYSize[$index][0];
                $y += $adjustXYSize[$index][1];
                $this->size = $adjustXYSize[$index][2];
                $img->text($char, $x, $y, function($font){
                    $fontPath = storage_path('app/public/SourceHanSerif-Heavy.otf');
                    $font->file($fontPath);
                    $font->size($this->size);
                    $font->color('#fc2414');
                    $font->align('center');
                    $font->valign('top');
                });
                $index++;
            }
        }


        $save_path = storage_path('app/public/'.$printName.'.png');
        $img->save($save_path);
        $downloadLink = asset('storage/'.$printName.'.png');
        $returnArray = [
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
