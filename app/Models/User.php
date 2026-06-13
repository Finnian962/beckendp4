<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'email', 'password', 'rolename'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @var list <string>>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Haal een gebruiker op via ID
    public function sp_GetUserById($id)
    {
        $result = DB::select('CALL sp_GetUserById(:id)', ['id' => $id]);

        return $result;
    }

    // Haal alle gebruikers op behalve de ingelogde gebruiker
    public function sp_GetAllUsers($user_id)
    {
        $result = DB::select('CALL sp_GetAllUsers(?)', [$user_id]);

        return $result;
    }
    
    // Haal alle gebruikersrollen op
    public function sp_GetAllUserrolles()
    {
        $result = DB::select('CALL sp_GetAllUserrolles()');

        return $result;
    }

    // Update een gebruiker
    public function sp_UpdateUser($id, $name, $email, $rolename)
    {
        $result = DB::update('CALL sp_UpdateUser(?, ?, ?, ?)', [$id, $name, $email, $rolename]);

        return $result;
    }

    public function sp_DeleteUser($id)
    {
        $result = DB::delete('CALL sp_DeleteUser(?)', [$id]);
        return $result;
    }
}