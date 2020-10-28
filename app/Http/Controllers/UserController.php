<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller {
    public function index() {
        $users = User::where('is_admin', '!=', 1)->get();
        return view('admin.user.index', compact('users'));
    }
    public function destroy($id) {
        User::find($id)->delete();
        notify()->success('User deleted successfully');
        return redirect()->back();
    }
}
