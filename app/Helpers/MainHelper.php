<?php

if (!function_exists('array_to_object')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function array_to_object($array)
    {
        return json_decode(json_encode($array));
    }
}
if (!function_exists('eloquent_to_options')) {
    function eloquent_to_options($array, $value, $title, $child=null)
    {
        $arr = array();
        foreach ($array as $index => $a) {
            $arr[$index]['value'] = $a->$value;
            if(is_null($child)){
                $arr[$index]['title'] = $a->$title;
            }else{
                $arr[$index]['title'] = $a->$title->$child;
            }
        }
        return $arr;
    }
}
if (!function_exists('eloquent_to_selected')) {
    function eloquent_to_selected($array, $value = 'id')
    {
        $arr = array();
        foreach ($array as $index => $a) {
            $arr[$index] = $a->$value;
        }
        return $arr;
    }
}
if (!function_exists('collection_match')) {
    function collection_match($array, $matchKey, $matchValue, $get)
    {
        foreach ($array as $index => $a) {
            if($a[$matchKey] == $matchValue){
                return $a[$get];
            }
        }
        return null;
    }
}
if (!function_exists('flip_selected_key')) {
    function flip_selected_key($array)
    {
        $flip = array_flip($array);
        foreach ($flip as $index => $a) {
            $flip[$index] = 1;
        }
        return $flip;
    }
}
if (!function_exists('filter_value')) {
    function filter_checkbox_value($array)
    {
        $arr = [];
        foreach ($array as $key => $item) {
            if($item != false){
                array_push($arr,$key);
            }
        }
        return $arr;
    }
}
if (!function_exists('text_to_slug')) {
    function text_to_slug($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }
}
if (!function_exists('empty_fallback')) {
    /**
     * Empty data or null data fallback to string -
     *
     * @return string
     */
    function empty_fallback ($data)
    {
        return ($data) ? $data : "-";
    }
}
if (!function_exists('create_button')) {
    function create_button ($action, $model)
    {
        $action = str_replace($model, "", $action);

        return [
            'submit_text' => ($action == "update") ? "Perbarui" : "Simpan",
            'submit_response' => ($action == "update") ? "Diperbarui." : "Disimpan.",
            'submit_response_notyf' => ($action == "update") ?
                "Data ".$model." Berhasil diperbarui" : "Data ".$model." Berhasil ditambahkan"
        ];
    }
}
if (!function_exists('itteration')) {
    function itteration ($sort, $loop, $perPage, $models)
    {
        if($sort == 1)
        {
            return $models->total()-$loop->iteration+1-(($models->currentpage()-1) * $perPage );
        }else
        {
            return ($models->currentPage()-1) * $perPage + $loop->iteration;
        }
    }
}
if (!function_exists('date_record')) {
    function date_record ($model)
    {
        $time   = $model->created_at->format('d M Y H:i');
        $modify = is_null($model->updated_at) ? '': 'Diperbarui: '.$model->updated_at->diffForHumans();
        return "$time<br>$modify";
    }
}
if (!function_exists('file_type')) {
    function file_type ($extension)
    {
        $image = array("jpg", "png", "gif", "webp", "tiff", "psd", "raw", "bmp", "heif", "indd", "jpeg");
        if (in_array($extension, $image)){
            return 'image';
        }else{
            return 'file';
        }
    }
}
if (!function_exists('is_last')) {
    function is_last($arr, $loop)
    {
        if(count($arr) == $loop->iteration) return true;
        return false;
    }
}
