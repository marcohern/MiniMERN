<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as IImage;

use App\User;
use App\Http\Controllers\Controller;
use App\Lib\Dimage;
use App\Lib\Dimager;
use App\Lib\Utility;
use App\Lib\DimageId;

class UsersController extends Controller
{
    public function __construct() {

    }

    public function browse() {
        $users = User::all();
        return $users;
    }

    public function get($id) {
        $user = User::find($id);
        return $user;
    }

    public function create(Request $request) {
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = new \Datetime("now");
        $user->name = $request->input('name');
        $user->desc = $request->input('desc');

        $r = $user->save();

        return [
            'id' => $user->id,
            'success' => $r
        ];
    }

    public function update($id, Request $request) {
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = new \Datetime("now");
        $user->name = $request->input('name');
        $user->desc = $request->input('desc');
        $r = $user->save();

        return ['success' => $r];
    }

    public function delete($id) {
        $user = User::find($id);

        $r = $user->delete();

        return ['success' => $r];
    }

    public function postimg($id, Request $r) {

        return ['success' => $r];
        /*

        $domain = $r->session()->get('dimages-domain',function () {
            return Utility::tempDomain();
        });
        $nslug = $r->session()->get('dimages-nslug',function () {
            return 0;
        });

        $r->session()->put('dimages-domain', $domain);
        $r->session()->put('dimages-nslug', $nslug);

        $filename = $r->dimage->getClientOriginalName();
        $dimage = new Dimage(
            $domain,
            Utility::padded($nslug),
            0, 'org', 'org',
            $r->dimage->getClientOriginalExtension(),
            DimageId::get()
        );
        $nslug++;
        //dd($nslug);
        $r->session()->put('dimages-nslug', $nslug);
        $r->dimage->storeAs('public',$dimage->getFileName());
        

        //dd($appPath, $dimager,$domain, $dimages);
        //return view('dimages::upload',['domain' => $domain, 'dimages' => $dimages]);
        */
    }
}
