<div class="col-span-6 form-group sm:col-span-5" wire:ignore>
    @if($title != '')
        <label for="{{str_replace(".", "", $model)}}">{{$title}}</label>
    @endif
    <textarea type="text" input="description" id="{{str_replace(".", "", $model)}}"
              class="form-control summernote" required></textarea>
    @error($model) <span class="error">{{ $message }}</span> @enderror
    <script>
        document.addEventListener('livewire:load', function () {
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $("textarea#{{str_replace('.', '', $model)}}").val(@this.get('{{$model}}'));
            $('#{{str_replace(".", "", $model)}}').summernote({
                dialogsInBody: true,
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'italic', 'clear']],
                    ['fontname', ['fontsize','fontname']],
                    ['color', ['forecolor']],
                    ['para', ['ul', 'ol', 'paragraph','hr']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['undo', 'redo', 'codeview','fullscreen']],
                ],
                callbacks: {
                    onImageUpload: function (files) {
                        var data = new FormData();
                        for (let i = 0; i < files.length; i++) {
                            data.append('file',files[i]);
                            data.append('directory','file');
                            data.append('_token',_token);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': _token,
                                },
                                data: data,
                                type: "POST",
                                url: "{{ route('admin.file-manager.store') }}",
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    $('#{{str_replace(".", "", $model)}}').summernote('editor.insertImage', res.path);
                                }
                            });
                        }
                        console.log('file loading');
                    },
                    onChange: function (content, $editable) {
                    @this.set('{{$model}}', content)
                    },
                }
            });
            Livewire.on('clearSelected', val => {
                $('#{{str_replace(".", "", $model)}}').summernote('reset');
            });
            Livewire.on('setText', val => {
                $('#'+val[0]).summernote('reset');
                $('#'+val[0]).summernote('code', val[1]);
            });
            Livewire.on('pasteText', val => {
                $('#'+val[0]).summernote('editor.pasteHTML', val[1]);
            });
        });
    </script>

</div>
