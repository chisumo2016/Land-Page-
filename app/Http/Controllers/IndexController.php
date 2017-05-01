<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Service;
use App\Portifolio;
use App\People;

class IndexController extends Controller
{
    //
    public function  execute(Request $request)
    {
        $pages       = Page::all();
        $portifolios = Portifolio::get(array('name','filters','images'));
        $services    = Service::where('id', '<', 20)->get();
        $peoples     = People::take(3)->get();

        $menu  = [];
        foreach ($pages  as $page) {
            $item = ['title' => $page->name, 'alias' => $page->alias];
            array_push($menu, $item);

            $item = array('title' => 'Services', 'alias' => 'service');
            array_push($menu, $item);

            $item = array('title' => 'Portfolio', 'alias' => 'Portfolio');
            array_push($menu, $item);

            $item = array('title' => 'Team', 'alias' => 'team');
            array_push($menu, $item);

            $item = array('title' => 'Contact', 'alias' => 'contact');
            array_push($menu, $item);
            return view('index', array(

                'menu'           =>  $menu,
                'pages'          => $pages,
                'services'       =>  $services,
                'portifolio'     =>  $portifolios,
                'peoples'        =>    $peoples,

            ));

        }
    }
}
