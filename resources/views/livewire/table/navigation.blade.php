<div>
    <x-data-table :data="$data" :model="$navigations">
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('sequence')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'sequence'])
                </span></th>
                <th><span wire:click.prevent="sortBy('label')" role="button" href="#">
                    Label
                    @include('components.sort-icon', ['field' => 'label'])
                </span></th>
                <th><span wire:click.prevent="sortBy('sequence')" role="button" href="#">
                    Sub
                    @include('components.sort-icon', ['field' => 'sequence'])
                </span></th>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    Urutan
                </span></th>
                <th><span wire:click.prevent="sortBy('slug')" role="button" href="#">
                    Tautan
                    @include('components.sort-icon', ['field' => 'slug'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($navigations as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $navigations) }}</td>
                    <td>
                        <b>{{ Str::limit($item->label, 110) }}</b>
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.navigation.edit'))
                            <a role="button" wire:click="$emit('showUpdateModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.navigation.delete'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td>{!! $item->child_of ? $item->parent->label?? '<i>Dihapus</i>' : '<span class="text-primary">Utama</span>' !!}</td>
                    <td class="form-inline">
                        <a class="btn btn-sm btn-light" wire:click="setSequence({{ $item->id }},'up')">
                            <i class="fas fa-sort-up"></i></a>
                        <a class="btn btn-sm btn-light" wire:click="setSequence({{ $item->id }},'down')">
                            <i class="fas fa-sort-down"></i></a>
                    </td>
                    <td>{{ $item->slug }}</td>
                </tr>
                @empty
                <tr><td colspan="100" class="text-center">Tidak ada hasil</td></tr>
            @endforelse
        </x-slot>
    </x-data-table>
</div>
