<?php

namespace App\Http\Controllers;

use App\Lib\DimageId;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as IImage;
use App\Lib\Dimage;
use App\Lib\Dimager;
use App\Lib\Utility;

class DimagesController extends Controller {
    
    public function index() {
        return view('index');
    }

    public function upload(Request $r) {
        //$r->session()->forget('dimages-domain');
        //$r->session()->forget('dimages.nsulg');
        
        $appPath = storage_path('app/public');
        $dimager = new Dimager($appPath);
        

        $domain = $r->session()->get('dimages-domain',function () {
            return Utility::tempDomain();
        });
        $nslug = $r->session()->get('dimages-nslug',function () {
            return 0;
        });
        $r->session()->put('dimages-domain', $domain);
        $r->session()->put('dimages-nslug', $nslug);
        
        $dimages = $dimager->getDomain($domain);

        //dd($appPath, $dimager,$domain, $dimages);
        return view('upload',['domain' => $domain, 'dimages' => $dimages]);
    }

    public function store(Request $r) {
        return view('upload',['domain' => $domain, 'dimages' => $dimages]);
        /*
        $filename = $r->picture->getClientOriginalName();
        //return ['success' => true, 'id' => $id, 'filename' => $filename];
        $nslug = 0 + $r->session()->get('dimages-nslug');
        $dimage = new Dimage(
            $r->session()->get('dimages-domain'),
            Utility::padded($nslug),
            0, 'org', 'org',
            $r->dimage->getClientOriginalExtension(),
            DimageId::get()
        );
        $nslug++;
        //dd($nslug);
        $r->session()->put('dimages-nslug', $nslug);
        $r->dimage->storeAs('public',$dimage->getFileName());
        return redirect()->route('image-upload');
        */
    }

    public function attach(Request $r) {

        $appPath = storage_path('app/mhn/dimages');

        $domain = $r->session()->get('dimages-domain');
        
        $i=0;
        $newDomain = $r->input('domain');
        $newSlug = $r->input('slug');
        $dimager = new Dimager($appPath);
        $dimages = $dimager->getDomain($domain);
        foreach ($dimages as $oldDimage) {
            
            $newDimage = new Dimage($newDomain, $newSlug, $i, 'org', 'org', $oldDimage->ext,$oldDimage->id);
            
            $dimager->renameImage($oldDimage, $newDimage);
            $i++;
        }
        $dimager->deleteAll($domain);
        $r->session()->forget('dimages-domain');
        $r->session()->forget('dimages-nsulg');
        return redirect()->route('dimages-index');
    }

    public function about() {
        return view('dimages::about');
    }

    public function api() {
        return response()->json([
            'success' => true,
            'api' => true
        ]);
    }
}