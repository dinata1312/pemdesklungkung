<form action="{{route('form.post', $form_slug)}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="form">
    @forelse ($questions as $item)
        @php
            $options = [];
            $meta = json_decode($item->question->meta,true);
            if(!is_null($meta)){
                if ( array_key_exists('option', $meta) ) {
                    $options = $meta['option'];
                }
            }
        @endphp
        <div class="form-group">
            <label for="field-{{ $loop->iteration }}">{{ $item->question->label }}</label> @if ($item->question->required ?? False) @include('components.required') @endif
        @if (in_array($item->question->type,['radio','number','date','text-long','select-one','select-multiple','file-upload']))
            <span class="mb-2 text-gray-500 d-block">{{ $item->question->placeholder }}</span>
        @endif
        @if (in_array($item->question->type,['text','number','date','email']))
            <input name="{{ id_enc($item->question->id, 'respon') }}"  type="{{ $item->question->type }}" class="form-control" id="field-{{ $loop->iteration }}" {{ $item->question->required ? 'required' : '' }}
                placeholder="{{ $item->question->placeholder }}">
        @elseif ($item->question->type=='long-text')
            <textarea name="{{ id_enc($item->question->id, 'respon') }}" class="form-control" id="field-{{ $loop->iteration }}" {{ $item->question->required ? 'required' : '' }}
                rows="10"></textarea>
        @elseif ($item->question->type=='radio')
        <div class="form-group">
            @forelse ($options as $option)
            <div class="custom-control custom-radio custom-control-inline">
                <input name="{{ id_enc($item->question->id, 'respon') }}" type="radio" id="radio{{ $loop->iteration }}" value="{{ $option }}" {{ $item->question->required ? 'required' : '' }}
                    class="custom-control-input">
                <label class="custom-control-label"
                    for="radio{{ $loop->iteration }}">{{ $option }}</label>
            </div>
            @empty
                <i>Tidak ada opsi</i>
            @endforelse
        </div>
        @elseif (in_array($item->question->type,['select-one','select-multiple']))
        @php
            $multi = null;
            $multi = explode('-',$item->question->type)[1];
        @endphp
        <select name="{{ id_enc($item->question->id, 'respon') }}{{ $multi=="multiple" ? '[]':'' }}" class="custom-select form-select" id="field-{{ $loop->iteration }}" {{ $item->question->required ? 'required' : '' }}
            {{ $multi=="multiple" ? 'multiple':'' }}>
            <option disabled>Pilih {{ $multi=="multiple" ? 'lebih dari satu':'salah satu' }}</option>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
        {!! $multi=="multiple" ? '<small>Gunakan ctrl untuk memilih lebih dari satu</small>':'' !!}
        @elseif ($item->question->type=='file-upload')
        <input name="{{ id_enc($item->question->id, 'respon') }}" type="file" class="form-control" {{ $item->question->required ? 'required' : '' }}>
        @endif
        </div>
    @empty
        Belum Ada Pertanyaan
    @endforelse
</div>
<input class="btn btn-primary" name="submit" type="submit" value="simpan">
</form>
