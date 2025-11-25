<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\User
 * Modelo Eloquent compatible con Laravel Auth.
 * Además mantiene métodos legacy utilizados por el código antiguo, implementados
 * sobre el facade DB para devolver arrays cuando el legacy los espera.
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;

    // --- Métodos legacy adaptados ---
    public function findByEmail($email)
    {
        $row = DB::table($this->table)->where('email', $email)->first();
        return $row ? (array) $row : null;
    }

    public function findById($id)
    {
        $row = DB::table($this->table)->where('id', $id)->first();
        return $row ? (array) $row : null;
    }

    public function findByUsername($username)
    {
        $row = DB::table($this->table)->where('username', $username)->first();
        return $row ? (array) $row : null;
    }

    public function createLegacy(array $data)
    {
        $payload = [
            'username' => $data['username'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
            'role' => $data['role'] ?? 'user',
            'status' => $data['status'] ?? 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return DB::table($this->table)->insertGetId($payload);
    }

    public function emailExists($email)
    {
        $count = DB::table($this->table)->where('email', $email)->count();
        return $count > 0;
    }

    public function usernameExists($username)
    {
        $count = DB::table($this->table)->where('username', $username)->count();
        return $count > 0;
    }

    public function isLocked($userId)
    {
        $row = DB::table($this->table)->where('id', $userId)->first(['locked_until']);
        if ($row && $row->locked_until) {
            return strtotime($row->locked_until) > time();
        }
        return false;
    }

    public function incrementFailedAttempts($userId)
    {
        DB::table($this->table)->where('id', $userId)->increment('failed_attempts');

        $failed = DB::table($this->table)->where('id', $userId)->value('failed_attempts');
        if ($failed >= 5) {
            DB::table($this->table)->where('id', $userId)->update([
                'locked_until' => DB::raw("DATE_ADD(NOW(), INTERVAL 15 MINUTE)"),
            ]);
        }
    }

    public function resetFailedAttempts($userId)
    {
        return DB::table($this->table)->where('id', $userId)->update([
            'failed_attempts' => 0,
            'locked_until' => null,
        ]);
    }

    public function updateLastLogin($userId)
    {
        return DB::table($this->table)->where('id', $userId)->update(['last_login' => now()]);
    }

    public function updatePassword($userId, $hashedPassword)
    {
        return DB::table($this->table)->where('id', $userId)->update(['password' => $hashedPassword]);
    }

    public function getAll()
    {
        $rows = DB::table($this->table)
            ->select('id', 'username', 'email', 'role', 'status', 'last_login', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return array_map(function ($r) { return (array) $r; }, $rows->toArray());
    }

    public function count()
    {
        return (int) DB::table($this->table)->count();
    }

    public function paginateLegacy($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $rows = DB::table($this->table)
            ->select('id', 'username', 'email', 'role', 'status', 'last_login', 'created_at')
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return array_map(function ($r) { return (array) $r; }, $rows->toArray());
    }

    public function updateUser($id, $data)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }

    public function updateRole($userId, $role)
    {
        return DB::table($this->table)->where('id', $userId)->update(['role' => $role]);
    }

    public function updateStatus($userId, $status)
    {
        return DB::table($this->table)->where('id', $userId)->update(['status' => $status]);
    }
}
// Alias global para compatibilidad con código legacy que usa `User` sin namespace
if (!\class_exists('User') && \class_exists(\App\Models\User::class)) {
    \class_alias(\App\Models\User::class, 'User');
}

