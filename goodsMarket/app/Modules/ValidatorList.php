<?php

namespace App\Modules;
use Illuminate\Support\Facades\Log;

/**
 * regex있는 애 image, phone(가입), email(가입), password(로그인), name, nickname(가입)
 */
class ValidatorList
{
    public static $image = "image|mimes:jpeg,png,jpg,gif,svg|max:2048";
    public static $phone = "required|unique:users,u_phone_num|regex:/^\d{3}\d{4}\d{4}$/";
    public static $email = "required|unique:users,u_email|email";
    public static $password = "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/";
    public static $name = "required|regex:/^[A-Za-z가-힣\s\.\-]+$/|min:2|max:30";
    public static $nickname = "required|unique:users,u_nickname|regex:/^[가-힣A-Za-z]{2,30}$/";
}