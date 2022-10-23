@if ( $this->size != "small" )
<div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        <div class="flex pb-4 -ml-3">
            @endif
            <div class="card-body" style="padding:0">
                <ul class="nav nav-tabs" id="tab" role="tablist">
                    @if (perm('admin.file-manager.create'))
                    <li class="nav-item" wire:click="$set('active', 'upload')">
                        <a class="nav-link {{ $active== 'upload' ? 'active' : '' }}" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="{{ $active== 'upload' ? 'true' : 'false' }}">
                            Unggah</a>
                    </li>
                    @endif
                    <li class="nav-item" wire:click="$set('active', 'document')">
                        <a class="nav-link {{ $active== 'document' ? 'active' : '' }}" id="document-tab" data-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="{{ $active== 'document' ? 'true' : 'false' }}">
                            Berkas</a>
                    </li>
                    <li class="nav-item">
                        <div class="col form-inline">
                            Grup: &nbsp;
                            <select id="my-select" class="ml-2 shadow-none form-control" wire:click="changeDir($event.target.value)">
                                @foreach ( $this->directoryOption as $opt)
                                <option value="{{ $opt }}" {{ $this->directory == $opt ? 'selected' : ''}}>
                                    {{ ucfirst($opt) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                </ul>
                <div class="tab-content" id="TabContent">
                    @if (perm('admin.file-manager.create'))
                    <div class="tab-pane fade {{ $active== 'upload' ? 'show active' : '' }}" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        <form action="{{ route('admin.file-manager.store') }}" class="dropzone" id="dropzone">
                            @csrf
                            <input class="form-control" type="hidden" name="directory" value="{{ $this->directory }}">
                            <div class="fallback">
                                <div class="dz-default dz-message"><span>Seret berkas untuk mengunggah</span></div>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="tab-pane fade {{ $active== 'document' ? 'show active' : '' }}" id="document" role="tabpanel" aria-labelledby="document-tab">
                        <ul class="mb-3 nav">
                            <li class="nav-item">
                                <div class="col form-inline">
                                    Per Hal: &nbsp;
                                    <select wire:model="perPage" class="form-control">
                                        <option>{{ $basePage = $this->size != "small" ? 12 : 6 }}</option>
                                        <option>{{ $basePage*2 }}</option>
                                        <option>{{ $basePage*3 }}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-inline">
                                    Cari: &nbsp;
                                    <input wire:model="search" class="form-control" type="text" placeholder="Pencarian...">
                                </div>
                            </li>
                        </ul>
                        <div class="form-group">
                            <div class="gallery gallery-md">
                                <div class="row gutters-sm">
                                    @forelse ($files as $item)
                                        <div class="mb-4 col-6 col-sm-{{ $this->size == "small" ? '4' : '2' }} ">
                                            <label class="imagecheck">
                                            @if( $this->size == "small" )
                                            <input name="imagecheck[]" type="checkbox" value="1" class="imagecheck-input"
                                                wire:model="selected.{{ $item->id }}" {{ $this->isSelected($item->id) ? 'checked=""' : '' }}
                                                wire:click="selectObject">
                                            @endif
                                            <figure class="imagecheck-figure">
                                                @php
                                                    $name = $item->filename.".".$item->extension;
                                                    $image = file_type($item->extension) == 'image' ? asset("/storage/$item->path") : 'file';
                                                @endphp
                                                @if ($image == 'file')
                                                    <i class="far fa-file-alt fa-7x"></i>
                                                @else
                                                    <img src="{{ $image }}" alt="{{ $name }}" class="imagecheck-image" style="max-height: 200px">
                                                @endif
                                            </figure>
                                            </label>
                                            <div class="form-inline"  x-data="window.__controller.dataTableControllerAlt({{ $item->id }}, 'App\\Models\\Blob')">
                                                @if ($image == 'file')
                                                <a href="{{ asset("/storage/$item->path") }}" class="text-success" target="_blank">
                                                    <i class="fas fa-arrow-circle-down"></i>
                                                </a>
                                                @else
                                                <a class="image-pop" href="{{ $image }}" target="_blank" title="{{ $name }}">
                                                    <i class="fas fa-search-plus text-info" ></i></a>
                                                @endif
                                                @if (perm('admin.file-manager.edit'))
                                                    <a href="#" class="text-warning" data-toggle="modal" data-target="#editBlob">
                                                        <i class="fas fa-pen" ></i>
                                                    </a>
                                                <div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="editBlob" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <a href="#" class="text-primary" onclick="copyLink({{ $item->id }})">
                                                    <i class="fas fa-link"></i>
                                                </a>
                                                @if (perm('admin.file-manager.edit'))
                                                <a href="#" class="ml-1 text-danger" role="button" x-on:click.prevent="deleteItem">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @endif
                                                <input value="{{ asset("/storage/$item->path") }}" id="link-{{ $item->id }}" style="display:none">
                                            </div>
                                            <p>{{ Str::limit($name, 11) }}</p>
                                        </div>
                                    @empty
                                    <h3 class="pt-12 pb-12 text-center cursor-pointer margin-center" wire:click="$set('active', 'upload')">
                                        Belum ada file, Klik untuk unggah file
                                    </h3>
                                    @endforelse
                                </div>
                                <div id="table_pagination" class="py-3">
                                    {{ $files->onEachSide(1)->links() }}
                                </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>
            @if ( $this->size != "small" )
        </div>
    </div>
</div>
@endif
<script>
    document.addEventListener('livewire:load', function () {
        $('#editBlob').on('shown.bs.modal', function () {
          $(".modal-backdrop").hide();
        });
        Dropzone.options.dropzone = {
        init: function () {
            this.on("complete", function (file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    Livewire.emit("successUpload", file);
                    }
            });
            }
        };

        $('.image-pop').magnificPopup({type:'image',image: {
                titleSrc: 'title'
            }});
        Livewire.on('successUpload', val => {
            $('.image-pop').magnificPopup({type:'image',image: {
                titleSrc: 'title'
            }});
        });
        Livewire.on('clearBlob', val => {
            $('.imagecheck-input').each(function()
            {
               this.checked = false;
            });
        });
    });
</script>

