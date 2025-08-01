<?php

namespace App\Enums;

enum UserRole: string
{
    case MAHASISWA = 'mahasiswa';
    case PEMBINA = 'pembina';
    case STAFF = 'staff';
}