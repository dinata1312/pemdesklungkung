{{-- Search & Button --}}
<div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        {{ $cape ?? '' }}
        <div class="flex pb-4 -ml-3">
            @if (property_exists($data->href, 'create_new'))
                @if (perm("admin.$this->name.create"))
                <a href="{{ $data->href->create_new }}"  class="shadow-none -ml- btn btn-primary">
                    <span class="fas fa-plus"></span> {{ $data->href->create_new_text }}
                </a>
                @endif
            @elseif (property_exists($data->href, 'create_new_text'))
                @if (perm("admin.$this->name.create"))
                <a wire:click="$emit('showCreateModal')" class="shadow-none -ml- btn btn-primary" data-toggle="modal">
                    <span class="fas fa-plus"></span> {{ $data->href->create_new_text }}
                </a>
                @endif
            @endif
            @if (property_exists($data->href, 'export'))
            <a href="{{ $data->href->export }}" class="ml-2 shadow-none btn btn-success">
                <span class="fas fa-file-export"></span> {{ $data->href->export_text }}
            </a>
            @endif
            {{ $button ?? '' }}
        </div>
        <div class="mb-4 row">
            <div class="col form-inline">
                Per Hal: &nbsp;
                <select wire:model="perPage" class="form-control">
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                </select>
            </div>

            <div class="col">
                <input wire:model="search" class="form-control" type="text" placeholder="Pencarian...">
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table text-sm text-gray-600 table-bordered table-striped">
                    <thead>
                        {{ $head }}
                    </thead>
                    <tbody>
                        {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>

        <div id="table_pagination" class="py-3">
            {{ $model->onEachSide(1)->links() }}
        </div>
    </div>
</div>

