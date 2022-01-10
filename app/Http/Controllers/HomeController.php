<?php

namespace App\Http\Controllers;



use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        return view('url');
    }

    public function createUrl(Request $request)
    {

        $request->validate([
            'url' => 'string|required'
        ]);

        $url = $request->input('url');

        do {
            $shortUrl = Str::random(10);
        } while (Url::where('short_url', $shortUrl)->first());

        $urlObject = new Url();
        $urlObject->short_url = $shortUrl;
        $urlObject->redirect_url = $url;
        $urlObject->save();

        return response()->json([
            'short_url' => url('/').'/'. $shortUrl
        ]);

    }

    public function goto(string $shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->first();
        if($url!==null){
            return redirect($url->redirect_url);
        }
        abort(404);
    }

}
