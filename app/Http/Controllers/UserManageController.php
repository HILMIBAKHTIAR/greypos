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
use Illuminate\Support\Facades\Redirect;

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
                $users->gaji = $req->gaji;
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

                Session::flash('message', 'Akun baru berhasil dibuat');

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
                    $access->kelola_produk = 0;
                    $access->transaksi = 1;
                    $access->kelola_laporan = 0;
                    $access->save();
                }

                Session::flash('message', 'Akun baru berhasil dibuat');

                return redirect('/user');
            } else if ($check_email != 0 && $check_username != 0) {
                Session::flash('both_error', 'Email dan username telah digunakan, silakan coba lagi');

                return back();
            } else if ($check_email != 0) {
                Session::flash('email_error', 'Email telah digunakan, silakan coba lagi');

                return back();
            } else if ($check_username != 0) {
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
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'email',
            'username' => 'required',
            'gaji' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $req->get('name');
        $user->email = $req->get('email');
        $user->username = $req->get('username');
        $user->gaji = $req->get('gaji');
        $user->role = $req->get('role');
        $user->password = $req->get('password');
        if ($req->password != null) {
            $user->password = Hash::make($req->password);
        }
        if ($req->role == 'admin') {
            $access = new Acces;
            $access->$user = $user->id;
            $access->kelola_akun = 1;
            $access->kelola_produk = 1;
            $access->transaksi = 1;
            $access->kelola_laporan = 1;
            $access->save();
        } else {
            $access = new Acces;
            $access->$user = $user->id;
            $access->kelola_akun = 0;
            $access->kelola_produk = 0;
            $access->transaksi = 1;
            $access->kelola_laporan = 0;
            $access->save();
        }
        $user->update();
        return redirect('/user', with('message', 'akun berhasil di ubah'));
        // $users->save();

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
            } else if ($check_email != 0 && $check_username != 0 && $user_account->email != $req->email && $user_account->username != $req->username) {
                Session::flash('both_error', 'Email dan username telah digunakan, silakan coba lagi');

                return back();
            } else if ($check_email != 0 && $user_account->email != $req->email) {
                Session::flash('email_error', 'Email telah digunakan, silakan coba lagi');

                return back();
            } else if ($check_username != 0 && $user_account->username != $req->username) {
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
}
