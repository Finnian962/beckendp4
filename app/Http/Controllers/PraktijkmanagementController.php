<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PraktijkmanagementController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // view
        return view('praktijkmanagement.index',[
            'title' => 'Praktijkmanagement Home'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // haalt de gebruiker op die een wijziging krijgt.
        $user = $this->userModel->sp_GetUserById($id);

        // haalt alle gebruikersrollen op voor select
        $userrolles = $this->userModel->sp_GetAllUserrolles();

        return view('praktijkmanagement.edit',[
            'title' => 'wijzig de gebruikersrol',
            'user' => $user[0],
            'userrolles' => $userrolles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'rolename' => ['required', 'string',]
        ]);

        $affected = $this->userModel->sp_UpdateUser(
            $id,
            $validated['name'],
            $validated['email'],
            $validated['rolename']
        );

        if ($affected === 0) {
            return back()->with('error', 'Er is niets gewijzigd of error bestaat niet.');
        }

        return redirect()->route('praktijkmanagement.userrolles')
            ->with('success', 'user succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userid)
    {
        $result = $this->userModel->sp_DeleteUser($userid);

        if ($result >0){
            return redirect()->route('praktijkmanagement.userrolles')
            ->with('success', 'user succesvol verwijderd.');
        } else {
            return redirect()->route('praktijkmanagement.userrolles')
            ->with('error, er is niets verwijderd.');
        }
    }

    public function manageUserrolles()
    {
        $users = $this->userModel->sp_GetAllUsers(auth()->user()->id);
        return view('praktijkmanagement.userrolles', [
            'title' => 'Gebruikersrollen',
            'users' => $users
        ]);
    }
}