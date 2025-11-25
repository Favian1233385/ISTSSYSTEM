<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("is_admin");
    }

    public function index()
    {
        $users = User::paginate(10);
        return view("admin.crud.users.list", [
            "title" => "Gestión de Usuarios - ISTS Admin",
            "items" => $users,
        ]);
    }

    public function create()
    {
        return view("admin.crud.users.create", [
            "title" => "Crear Usuario - ISTS Admin",
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                "unique:users",
            ],
            "password" => ["required", "string", "min:8", "confirmed"],
            "role" => [
                "required",
                "string",
                Rule::in(["admin", "editor", "user"]),
            ],
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
        ]);

        return redirect()
            ->route("admin.users.index")
            ->with("success", "Usuario creado exitosamente.");
    }

    public function edit(User $user)
    {
        return view("admin.crud.users.edit", [
            "title" => "Editar Usuario - ISTS Admin",
            "item" => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                Rule::unique("users")->ignore($user->id),
            ],
            "password" => ["nullable", "string", "min:8", "confirmed"],
        ];

        if (auth()->id() !== $user->id) {
            $rules["role"] = [
                "required",
                "string",
                Rule::in(["admin", "editor", "user"]),
            ];
        }

        $request->validate($rules);

        $data = [
            "name" => $request->name,
            "email" => $request->email,
        ];

        if (auth()->id() !== $user->id) {
            $data["role"] = $request->role;
        }

        if ($request->filled("password")) {
            $data["password"] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route("admin.users.index")
            ->with("success", "Usuario actualizado exitosamente.");
    }

    public function destroy(User $user)
    {
        // Do not delete the currently logged in user
        if ($user->id === auth()->id()) {
            return back()->withErrors([
                "error" => "No puedes eliminar tu propio usuario.",
            ]);
        }

        $user->delete();
        return redirect()
            ->route("admin.users.index")
            ->with("success", "Usuario eliminado exitosamente.");
    }
}
