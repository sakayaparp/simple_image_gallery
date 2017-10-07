<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $inputs = $request->all();
        $filename_real = $request->file->store('images');

        $image = new Image();
        $image->email = $inputs['email'];
        $image->filename = $_FILES['file']['name'];
        $image->filename_real = $filename_real;
        $image->filesize = $_FILES['file']['size'];
        $image->filetype = $_FILES['file']['type'];
        $image->save();
    }

    public function getDiskUsageOverview(Request $request)
    {
        $results = array(
            'totalSize' => '0',
            'fullTotalSize' => '0',
            'noOfFile' => '0',
        );
        $inputs = $request->all();
        $datas = Image::where('email', $inputs['email'])->get();
        
        foreach ($datas as $data) {
            $results['fullTotalSize'] += $data->filesize;
        }

        $results['noOfFile'] = count($datas);
        $results['totalSize'] = number_format(($results['fullTotalSize'] / 1000000), 2) ;
        $results['fullTotalSize'] = number_format($results['fullTotalSize']);

        echo json_encode($results);
    }

    public function diskUsageCompositions(Request $request)
    {
        $results = array();
        $inputs = $request->all();
        // $datas = Image::where('email', $inputs['email'])->get();

        $datas = DB::table('image')
            ->select(DB::raw('filetype, COUNT(*) AS totalfile, SUM(filesize) AS totalsize'))
            ->where('email', $inputs['email'])
            ->groupBy('filetype')
            ->get();


        foreach ($datas as $data) {
            $results[] = array(
                'filetype' => $data->filetype,
                'totalfile' => $data->totalfile,
                'totalsize' => number_format($data->totalsize / 1000000, 2),
                'fullTotalsize' => $data->totalsize,
            );
        }

        echo json_encode($results);
    }
}
