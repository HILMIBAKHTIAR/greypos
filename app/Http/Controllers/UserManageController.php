<?php

namespace App\Http\Controllers;

use App\Acces;
use App\User;
use Session;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserManageController extends Controller
{
    // Show View Account
    public function viewAccount()
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
        if ($check_access->kelola_akun == 1) {
            $users = User::all();

            return view('user.index', compact('users'));
        } else {
            return back();
        }
    }

    //show user acess

    public function viewAccess()
    {
        $id_account =  Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        if ($check_access->kelola_akun == 1) {
            $users = User::all();
        }

    }
    // // Show View New Account
    // public function viewNewAccount()
    // {
    //     $id_account = Auth::id();
    //     $check_access = Acces::where('user', $id_account)
    //         ->first();
    //     if ($check_access->kelola_akun == 1) {
    //         return view('user.create');
    //     } else {
    //         return back();
    //     }
    // }

    // // Filter Account Table
    // public function filterTable($id)
    // {
    //     $id_account = Auth::id();
    //     $check_access = Acces::where('user', $id_account)
    //         ->first();
    //     if ($check_access->kelola_akun == 1) {
    //         $users = User::orderBy($id, 'asc')
    //             ->get();

    //         return view('manage_account.filter_table.table_view', compact('users'));
    //     } else {
    //         return back();
    //     }
    // }

    // Create New Account
    public function createAccount(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
        if ($check_access->kelola_akun == 1) {

            $check_email = User::all()
                ->where('email', $req->email)
                ->count();
            $check_username = User::all()
                ->where('username', $req->username)
                ->count();

            if ($req->foto != '' && $check_email == 0 && $check_username == 0) {
                $users = new User;
                $users->name = $req->name;
                $users->role = $req->role;
                $foto = $req->file('foto');
                $users->foto = $foto->getClientOriginalName();
                $foto->move(public_path('pictures/'), $foto->getClientOriginalName());
                $users->email = $req->email;
                $users->username = $req->username;
                $users->password = Hash::make($req->password);
                $users->remember_token = Str::random(60);
                $users->save();
                if ($req->role == 'admin') {
                    $access = new Acces;
                    $access->user = $users->id;
                    $access->kelola_akun = 1;
                    $access->kelola_produk = 1;
                    $access->transaksi = 1;
                    $access->kelola_laporan = 1;
                    $access->save();
                } else {
                    $access = new Acces;
                    $access->user = $users->id;
                    $access->kelola_akun = 0;
                    $access->kelola_produk = 1;
                    $access->transaksi = 1;
                    $access->kelola_laporan = 1;
                    $access->save();
                }

                Session::flash('create_success', 'Akun baru berhasil dibuat');

                return redirect('/user');
            } else if ($req->foto == '' && $check_email == 0 && $check_username == 0) {
                $users = new User;
                $users->name = $req->name;
                $users->role = $req->role;
                $users->foto = 'default.jpg';
                $users->email = $req->email;
                $users->username = $req->username;
                $users->password = Hash::make($req->password);
                $users->remember_token = Str::random(60);
                $users->save();
                if ($req->role == 'admin') {
                    $access = new Acces;
                    $access->user = $users->id;
                    $access->kelola_akun = 1;
                    $access->kelola_produk = 1;
                    $access->transaksi = 1;
                    $access->kelola_laporan = 1;
                    $access->save();
                } else {
                    $access = new Acces;
                    $access->user = $users->id;
                    $access->kelola_akun = 0;
                    $access->kelola_produk = 1;
                    $access->transaksi = 1;
                    $access->kelola_laporan = 1;
                    $access->save();
                }

                Session::flash('create_success', 'Akun baru berhasil dibuat');

                return redirect('/user');
            }
            else if ($check_email != 0 && $check_username != 0) {
                Session::flash('both_error', 'Email dan username telah digunakan, silakan coba lagi');

                return back();
            }
            else if ($check_email != 0) {
                Session::flash('email_error', 'Email telah digunakan, silakan coba lagi');

                return back();
            }
            else if ($check_username != 0) {
                Session::flash('username_error', 'Username telah digunakan, silakan coba lagi');

                return back();
            }
        } else {
            return back();
        }
    }

    // Edit Account
    public function editAccount($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
        if ($check_access->kelola_akun == 1) {
            $user = User::find($id);

            return response()->json(['user' => $user]);
        } else {
            return back();
        }
    }

    // Update Account
    public function updateAccount(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
        if ($check_access->kelola_akun == 1) {
            $user_account = User::find($req->id);
            $check_email = User::all()
                ->where('email', $req->email)
                ->count();
            $check_username = User::all()
                ->where('username', $req->username)
                ->count();

            if (($req->foto != '' && $check_email == 0 && $check_username == 0) || ($req->foto != '' && $user_account->email == $req->email && $user_account->username == $req->username) || ($req->foto != '' && $check_email == 0 && $user_account->username == $req->username) || ($req->foto != '' && $user_account->email == $req->email && $check_username == 0)) {
                $user = User::find($req->id);
                $user->nama = $req->nama;
                $user->role = $req->role;
                $foto = $req->file('foto');
                $user->foto = $foto->getClientOriginalName();
                $foto->move(public_path('pictures/'), $foto->getClientOriginalName());
                $user->email = $req->email;
                $user->username = $req->username;
                $user->save();

                Session::flash('update_success', 'Akun berhasil diubah');

                return redirect('/account');
            } else if (($req->foto == '' && $check_email == 0 && $check_username == 0) || ($req->foto == '' && $user_account->email == $req->email && $user_account->username == $req->username) || ($req->foto == '' && $check_email == 0 && $user_account->username == $req->username) || ($req->foto == '' && $user_account->email == $req->email && $check_username == 0)) {
                if ($req->nama_foto == 'default.jpg') {
                    $user = User::find($req->id);
                    $user->nama = $req->nama;
                    $user->role = $req->role;
                    $user->foto = $req->nama_foto;
                    $user->email = $req->email;
                    $user->username = $req->username;
                    $user->save();
                } else {
                    $user = User::find($req->id);
                    $user->nama = $req->nama;
                    $user->role = $req->role;
                    $user->email = $req->email;
                    $user->username = $req->username;
                    $user->save();
                }

                Session::flash('update_success', 'Akun berhasil diubah');

                return redirect('/account');
            }
            else if ($check_email != 0 && $check_username != 0 && $user_account->email != $req->email && $user_account->username != $req->username) {
                Session::flash('both_error', 'Email dan username telah digunakan, silakan coba lagi');

                return back();
            }
            else if ($check_email != 0 && $user_account->email != $req->email) {
                Session::flash('email_error', 'Email telah digunakan, silakan coba lagi');

                return back();
            }
            else if ($check_username != 0 && $user_account->username != $req->username) {
                Session::flash('username_error', 'Username telah digunakan, silakan coba lagi');

                return back();
            }
        } else {
            return back();
        }
    }

    // Delete Account
    public function deleteAccount($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/user')->with('status', 'Data Supplier Berhasil Dihapus');
    }
    // Delete Account
    // public function deleteAccount($id)
    // {
    //     $id_account = Auth::id();
    //     $check_access = Acces::where('user', $id_account)
    //         ->first();
    //     if ($check_access->kelola_akun == 1) {
    //         User::destroy($id);
    //         Acces::where('user', $id)->delete();

    //         Session::flash('delete_success', 'Akun berhasil dihapus');

    //         return back();
    //     } else {
    //         return back();
    //     }
    // }
}
