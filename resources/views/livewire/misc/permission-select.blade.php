
<div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <div class="p-8 {{ !$this->modify ? 'pt-4 mt-2' : 'pt-0' }}   bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        @if (!$this->modify)
            @if (perm('admin.privilage.perm.create'))
            <div class="flex pb-4 -ml-3">
                <a wire:click="$emit('showCreateModal')" class="shadow-none -ml- btn btn-primary" data-toggle="modal">
                    <span class="fas fa-plus"></span> {{ $data->href->create_new_text }}
                </a>
            </div>
            @endif
        @endif
        <div class="mb-4 row">
            <div class="card-body" style="padding:0">
                <ul class="nav nav-tabs" id="tab" role="tablist">
                    <li class="nav-item">
                        <div class="form-inline">
                            Cari Wewenang: &nbsp;
                            <input wire:model="search" class="form-control" type="text" placeholder="Pencarian...">
                        </div>
                    </li>
                </ul>
                <div class="tab-content" id="TabContent">
                    <div class="row">
                        @forelse ($permissions as $item)
                        <div class="mt-2 col-12 col-sm-6 col-lg-4"
                            x-data="window.__controller.dataTableController({{ $item->id }})">
                            <div class="mb-3 input-group" wire:click="selectObject">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    @if (!$this->modify)
                                    <div class="whitespace-no-wrap row-action--icon">
                                        @if (perm('admin.privilage.perm.edit'))
                                            <a role="button" wire:click="$emit('showUpdateModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                                        @endif
                                        @if (perm('admin.privilage.perm.delete'))
                                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                                        @endif
                                    </div>
                                    @else
                                    <input type="checkbox" name="permission" wire:model="permission.{{ $item->id }}" id="perm-{{ $item->id }}">
                                    @endif
                                  </div>
                                </div>
                                <label class="bg-white form-control" for="perm-{{ $item->id }}" style="word-wrap: break-word;height:auto;">{{ $item->name }}</label>
                            </div>
                        </div>
                        @empty
                        <h3 class="pt-12 pb-12 text-center cursor-pointer margin-center">
                            Tidak ada hasil
                        </h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

