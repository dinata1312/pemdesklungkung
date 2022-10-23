<table>
    <thead>
        <tr>
            @php
                $questionIds = [];
            @endphp
            @foreach ($form->formQuestions as $item)
                <th>{{ $item->question->label }}</th>
                @php
                    array_push($questionIds, $item->id)
                @endphp
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach ($form->formRespondents as $respondent)
        <tr>
        @foreach ($questionIds as $questionId)
        @php
            $value = collection_match($respondent->formResponses, 'form_question_id', $questionId, 'value');
            $pattern = '/^[[].*[]]$/';
            if($value){
                if (preg_match($pattern, $value)){
                    $temp = json_decode($value, True);
                    $value = implode(", ",$temp);
                }
            }
        @endphp
        <td>{{ $value ?? '-' }}</td>
        @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
