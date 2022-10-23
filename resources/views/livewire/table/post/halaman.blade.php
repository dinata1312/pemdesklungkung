<div>
    <x-data-table :data="$data" :model="$announcements">
        <x-slot name="button">
            @if (perm('admin.post.notice.create'))
            <a wire:click="$emit('showCreateModal')" class="shadow-none -ml- btn btn-primary" data-toggle="modal">
                <span class="fas fa-plus"></span> {{ $data->href->create_btn }}
            </a>
            @endif
            <div class="row">
                <div class="col form-inline">
                    <select id="my-select" class="ml-2 shadow-none form-control" wire:click="publishState($event.target.value)">
                        <option value="semua">
                            Semua</option>
                        <option value="terbit">
                            Diterbitkan</option>
                        <option value="konsep">
                            Konsep</option>
                    </select>
                </div>
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </span></th>
                <th><span wire:click.prevent="sortBy('title')" role="button" href="#">
                    Judul
                    @include('components.sort-icon', ['field' => 'title'])
                </span></th>
                <th><span wire:click.prevent="sortBy('created_by')" role="button" href="#">
                    Penulis
                    @include('components.sort-icon', ['field' => 'created_by'])
                </span></th>
                <th><span>
                    Kategori
                </span></th>
                <th class="text-center"><span wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($announcements as $item)
                <tr x-data="window.__controller.dataTableControllerAlt({{ $item->id }}, 'App\\Models\\Post')">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $announcements) }}</td>
                    <td>
                        <b>{{ Str::limit($item->title, 110) }}</b>
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.post.notice.edit'))
                            <a role="button" wire:click="$emit('showUpdateModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.post.notice.delete'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td>{!! $item->creator->name ?? '<i>Anonim</i>' !!}</td>
                    @php
                        $tags = $item->postTags;
                        $category = [];
                        foreach($tags as $tag){
                            array_push($category, $tag->tag->label);
                        }
                    @endphp
                    <td width="10%">
                        {!! collapse_more($category, $item->id,'tag',3) !!}
                    </td>
                    <td class="text-center">
                        {!! $item->publish==0 ? "<span class='badge badge-secondary text-dark'>Konsep</span>" : "<span class='badge badge-success'>Diterbitkan</span>" !!}<br>
                        {!! date_record($item) !!}
                    </td>
                </tr>
                @empty
                <tr><td colspan="100" class="text-center">Tidak ada hasil</td></tr>
            @endforelse
        </x-slot>
    </x-data-table>
</div>
