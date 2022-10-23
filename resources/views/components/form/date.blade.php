<div class="col-span-6 form-group sm:col-span-5" wire:ignore>
    @if($title != '')
        <label for="{{$title}}">{{$title}}</label>
    @endif
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
        <input id="{{str_replace(".", "", $model)}}" type="{{ $type }}"
               class="form-control" wire:model.defer="{{$model}}"/>
        @error($model) <span class="error">{{ $message }}</span> @enderror
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            $("#{{str_replace(".", "", $model)}}").on("change.datetimepicker", () => {
            @this.set('{{$model}}', $("#{{str_replace(".", "", $model)}}").val())
            });
        });
    </script>
</div>
