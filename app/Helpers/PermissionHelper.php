<?php

if (!function_exists('perm')) {
    function perm ($perm, $auth = True)
    {
        if($auth){
            $user = Illuminate\Support\Facades\Auth::user();
            return $user->hasPermissionTo($perm);
        }
        return false;
    }
}
if (!function_exists('anyPerm')) {
    function anyPerm ($perms, $auth = True)
    {
        if($auth){
            $user = Illuminate\Support\Facades\Auth::user();
            if(is_array($perms))
            {
                foreach($perms as $perm){
                    if( $user->hasPermissionTo($perm) ){
                        return True;
                    }
                }
            }else{
                return $user->can($perms);
            }
        }
        return false;
    }
}

if (!function_exists('allPerm')) {
    function allPerm ($perm, $auth = True)
    {
        if($auth){
            $user = Illuminate\Support\Facades\Auth::user();
            return $user->can($perm);
        }
        return false;
    }
}
