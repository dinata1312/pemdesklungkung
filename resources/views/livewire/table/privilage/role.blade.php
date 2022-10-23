<div>
    <x-data-table :data="$data" :model="$roles">
        <x-slot name="button">
            @if (perm('admin.privilage.role.create'))
            <a wire:click="$emit('showCreateModal')" class="shadow-none -ml- btn btn-primary" data-toggle="modal">
                <span class="fas fa-plus"></span> {{ $data->href->create_btn }}
            </a>
            @endif
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </span></th>
                <th><span wire:click.prevent="sortBy('name')" role="button" href="#">
                    Nama
                    @include('components.sort-icon', ['field' => 'label'])
                </span></th>
                <th><span>
                    Daftar Wewenang
                </span></th>
                <th class="text-center"><span wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal
                    @include('components.sort-icon', ['field' => 'created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($roles as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $roles) }}</td>
                    <td>
                        <b>{{ Str::limit($item->name, 110) }}</b>
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.privilage.role.edit'))
                            <a role="button" wire:click="$emit('showUpdateModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.privilage.role.delete'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td class="lh-2" width="60%">
                    @if(count($item->permissions)>=17)
                        <a data-toggle="collapse" href="#tagColapse{{ $item->id }}" role="button" aria-expanded="false">
                            Tampilkan({{ count($item->permissions) }})
                        </a>
                        <div class="collapse" id="tagColapse{{ $item->id }}">
                            @foreach ($item->permissions as $perm) <span class="badge badge-success">{{ $perm->name }}</span> @endforeach
                        </div>
                    @else
                        @foreach ($item->permissions as $perm) <span class="badge badge-success">{{ $perm->name }}</span> @endforeach
                    @endif
                    </td>
                    <td class="text-center">{!! date_record($item) !!}</td>
                </tr>
                @empty
                <tr><td colspan="100" class="text-center">Tidak ada hasil</td></tr>
            @endforelse
        </x-slot>
    </x-data-table>
</div>
