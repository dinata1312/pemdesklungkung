<div class="form-group" wire:ignore>
    @if($title != '')
        <label for="{{$model}}">{{$title}}</label>
    @endif
    <select id="{{$model}}" class="block form-control select2" {{ $multiple ? 'multiple=""' : '' }} style="width:100%;">
        @if (!$tags)
            <option selected disabled>--Pilih Opsi--</option>
        @endif
        @for($i=0;$i<count($options) ;$i++)
            <option value="{{$options[$i]['value']}}" {{ $isSelected($options[$i]['value']) ? 'selected="selected"' : '' }}>
                {{$options[$i]['title']}}
            </option>
        @endfor
    </select>
    {!! $allowNull ? '<span class="cursor-pointer" wire:click="$emit(`clearSelected`)">Kosongkan</span>' : '' !!}
    <script>
        @if (isset($alt) && $alt == True)
        $('#{{$model}}').on('change', function (e) {
            data = document.getElementById("{{$model}}").value;
            @this.set('{{$model}}', data);
        });
        @endif
        document.addEventListener('livewire:load', function () {
            let data;
            $('#{{$model}}').select2();
            $('#{{$model}}').on('change', function (e) {
                data = $('#{{$model}}').select2("val");
            @this.set('{{$model}}', data);
            });
            Livewire.on('clearSelected', val => {
                $('#{{$model}}').val([]);
                $('#{{$model}}').trigger('change');
            });
            Livewire.on('setSelectedOption', val => {
                if(val[0][0] != null){
                    if(typeof val[1] === 'undefined') {
                        var select = []; val[0].forEach(opt => { select.push(opt); });
                    }else{
                        var column = val[1];
                        var select = []; val[0].forEach(opt => { select.push(opt[column]); });
                    }
                    $('#{{$model}}').val(select);
                    $('#{{$model}}').trigger('change');
                }
            });
        });
    </script>
</div>
