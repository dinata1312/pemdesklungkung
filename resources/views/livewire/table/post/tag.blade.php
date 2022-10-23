<div>
    <x-data-table :data="$data" :model="$tags">
        <x-slot name="cape">
            <div class="mb-2 section-body">
                <h2 class="mt-0 section-title">Kategori</h2>
                <p class="section-lead">
                    Tag penanda pada konten</p>
            </div>
        </x-slot>
        <x-slot name="button">
            @if (perm('admin.tag.create'))
            <a wire:click="$emit('showCreateTagModal')" class="shadow-none -ml- btn btn-primary" data-toggle="modal">
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
                <th><span wire:click.prevent="sortBy('label')" role="button" href="#">
                    Label
                    @include('components.sort-icon', ['field' => 'title'])
                </span></th>
                <th><span wire:click.prevent="sortBy('term_id')" role="button" href="#">
                    Rumpun Topik
                    @include('components.sort-icon', ['field' => 'created_by'])
                </span></th>
                <th class="text-center"><span wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($tags as $item)
                <tr x-data="window.__controller.dataTableControllerAlt({{ $item->id }}, 'App\\Models\\Tag')">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $tags) }}</td>
                    <td>
                        <b>{{ Str::limit($item->label, 110) }}</b>
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.tag.edit'))
                            <a role="button" wire:click="$emit('showUpdateTagModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.tag.delete'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td>{!! $item->term->label ?? '<i>Tidak ada</i>' !!}</td>
                    <td class="text-center">
                        {!! date_record($item) !!}
                    </td>
                </tr>
                @empty
                <tr><td colspan="100" class="text-center">Tidak ada hasil</td></tr>
            @endforelse
        </x-slot>
    </x-data-table>
</div>
