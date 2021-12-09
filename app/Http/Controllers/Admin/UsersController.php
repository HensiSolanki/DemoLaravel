<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user = User::select([
            'id', 'name', 'username', 'email', 'image',
            DB::raw("image AS image_thumb_url")
        ]);
        if ($request->ajax()) {

            return Datatables::of($user)
                ->make(true);
        }
        return view('admin.users.index', compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
