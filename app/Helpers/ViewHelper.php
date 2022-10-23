<?php

if (!function_exists('collapse_more')) {
    function collapse_more($arr, $unique,$name="more", $limit = 3)
    {
        if ( count($arr)>=$limit ){
            return "<a data-toggle='collapse' href='#".$name.`Colapse`.id_enc($unique)."' role='button' aria-expanded='false'>
            Tampilkan(".count($arr).")</a>".
            "<div class='collapse' id='".$name.`Colapse`.id_enc($unique)."'>
            ".implode( ', ',$arr )."</div>"
            ;
        }else{
            return implode( ', ',$arr );
        }
    }
}

if (!function_exists('app_name')) {
    function app_name($plain = false)
    {
        $name = explode('-', config('app.name','Lite-Press') );
        if($plain) return implode(' ', $name);
        return $name;
    }
}

if (!function_exists('thumbnail')) {
    function thumbnail($post)
    {
        $notfound = asset('frontend/img/portfolio/portfolio-1.jpg');
        $img = $post ? asset($post->postImages->first() ? 'storage/'.$post->postImages->first()->image->path
          : $notfound): $notfound;
        return $img;
    }
}
