<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\CustomList;
use Illuminate\Support\Facades\Auth;

class CustomListController extends Controller
{
    /**
    * Create a new CustomListController instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Create a new list instance.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $list = new CustomList;
        $list->title = $request->title;
        $list->recipes_by_id = $request->recipes_by_id;
        $list->user_id = Auth::id();
        $list->save();

        return response()->json([
            'message' => 'Successfully created list',
            'data' => $list
        ], 200);
    }

    /**
     * Read all lists related to authenticated user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListsByAuthenticatedUser(Request $request)
    {   
        $id = Auth::id();
        $listsByUser = User::find($id)->customLists;

        return response()->json(['listsByUser' => $listsByUser]);
    }

    /**
     * Read favourites list related to authenticated user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFavouritesByAuthenticatedUser(Request $request) {

        $id = Auth::id();
        $favourites = CustomList::where('user_id', $id)->where('title', 'favourites')->first();
        
        return response()->json(['data' => $favourites]);
    }

     /**
     * Update favourites list related to authenticated user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCustomList(Request $request) {

        $list = CustomList::find($request->listId);
        $recipesById = $request->recipesById;
        $list->recipes_by_id = json_encode($recipesById); 
        $list->save();
        
        return response()->json(['data' => $list]);
    }

}
