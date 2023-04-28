<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }
    public function edit(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            // Redirect the user to an error page or show a 403 Forbidden error.
            abort(403, 'Unauthorized action.');
        }
        return view('users.edit', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required',
            'email' => 'required',
            'address' => 'required',
            'password' => 'required',
            'idNo' => 'required',
        ]);

        DB::table('users')->insert([
            'fullName' => $request->fullName,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'address' => $request->address,
            'idNo' => $request->idNo,
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()'),
        ]);

        // User::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullName' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'dateOfBirth' => 'required|date',
            'icNo' => 'required|numeric',
            'address' => 'required',
            'imagePath' => 'nullable|image|max:2048',
        ]);

        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->icNo = $request->icNo;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('imagePath')) {
            $imagePath = $request->file('imagePath');
            $filename = time() . '.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->storeAs('public/images', $filename);
            $oldFilename = $user->imagePath;
            $user->imagePath = $filename;
            if ($oldFilename) {
                Storage::delete('public/images/' . $oldFilename);
            }
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

}
