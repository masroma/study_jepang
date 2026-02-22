<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_model extends Model
{
    // kategori
    public function login($username,$password)
    {
        $query = DB::table('users')
            ->select('*')
            ->where(function($q) use ($username) {
                $q->where('users.username', $username)
                  ->orWhere('users.email', $username);
            })
            ->where('users.password', sha1($password))
            ->orderBy('id_user','DESC')
            ->first();
        return $query;
    }

    // Login dengan email atau username (untuk semua role termasuk Admin)
    public function loginByEmail($email, $password)
    {
        $query = DB::table('users')
            ->select('*')
            ->where(function($q) use ($email) {
                $q->where('users.email', $email)
                  ->orWhere('users.username', $email);
            })
            ->where('users.password', sha1($password))
            ->orderBy('id_user','DESC')
            ->first();
        return $query;
    }

    // Login dengan WhatsApp
    public function loginByWhatsApp($whatsapp, $password)
    {
        // Normalize WhatsApp number (remove +, spaces, dashes)
        $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);
        // If starts with 0, replace with 62
        if (substr($whatsapp, 0, 1) === '0') {
            $whatsapp = '62' . substr($whatsapp, 1);
        }
        // If doesn't start with 62, add it
        if (substr($whatsapp, 0, 2) !== '62') {
            $whatsapp = '62' . $whatsapp;
        }

        $query = DB::table('users')
            ->select('*')
            ->where(function($q) use ($whatsapp) {
                // Try exact match
                $q->where('users.whatsapp', $whatsapp)
                  // Try without 62 prefix
                  ->orWhere('users.whatsapp', substr($whatsapp, 2))
                  // Try with 0 prefix
                  ->orWhere('users.whatsapp', '0' . substr($whatsapp, 2))
                  // Try with +62 prefix
                  ->orWhere('users.whatsapp', '+' . $whatsapp);
            })
            ->where('users.password', sha1($password))
            ->orderBy('id_user','DESC')
            ->first();
        return $query;
    }
}
