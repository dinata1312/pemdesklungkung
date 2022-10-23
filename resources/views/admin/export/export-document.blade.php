<!DOCTYPE html>
<head>
    @php
    $name = '';
    if(isset($respondent)){
        $name = $respondent->user?$respondent->user->name : 'anonim';
    }
    @endphp
    <title>{{ $document->title.'-'.$name }}</title>
    <meta charset="utf-8">
    <style>

    </style>

</head>

<body>
@php
    $doc = $document->content;
    if(isset($respondent)){
        $response = $respondent->formResponses;
        $mailmerge = [];
        foreach ($response as $res){
            $marker = $res->formQuestion->question->marker;
            $value = $res->value;
            array_push($mailmerge, [$marker, $value]);
        }

        foreach ($mailmerge as $mark){
            $doc = str_replace("%".$mark[0]."%", $mark[1], $doc);
        }
    }
@endphp
{!! $doc !!}
</body>

</html>
