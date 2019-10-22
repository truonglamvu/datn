<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Menus\MenusRepository;
use App\Repository\Post\PostModel;
class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenusRepository $menuRepository, PostModel $postModel)
    {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
            $menus = $menuRepository->getAllMenu();
            return view('guest.index2',compact(['menus']));
    }
}
