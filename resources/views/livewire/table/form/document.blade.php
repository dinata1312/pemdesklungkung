<div>
    <x-data-table :data="$data" :model="$documents">
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </span></th>
                <th><span wire:click.prevent="sortBy('title')" role="button" href="#">
                    Judul Dokumen
                    @include('components.sort-icon', ['field' => 'title'])
                </span></th>
                <th><span wire:click.prevent="sortBy('content')" role="button" href="#">
                    Sample Isi
                    @include('components.sort-icon', ['field' => 'content'])
                </span></th>
                <th class="text-center"><span>
                    Aksi
                </span></th>
                <th class="text-center"><span wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($documents as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $documents) }}</td>
                    <td>
                        <b>{{ Str::limit($item->title, 110) }}</b>
                        {!! !is_null($item->form_id) ? '<i class="fas fa-lock text-warning" title="'.$item->form->name.'"></i>' : '' !!}
                        <br>
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.document.update'))
                            <a role="button" href="{{ route('admin.document.edit', id_enc($item->id,'doc')) }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.document.delete'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-danger fa fa-16px fa-trash"></i></a>
                            @endif
                            @if (perm('admin.document.create'))
                            <i role="button" class="ml-3 text-info fas fa-16px fa-copy" title="Duplikat" wire:click.prevent="cloneDocument({{ $item->id }})"></i>
                            @endif
                            @if (perm('admin.document.update') && !is_null($item->form_id))
                            <i role="button" class="ml-3 text-warning fas fa-16px fa-lock-open" title="Lepas koneksi" wire:click.prevent="unbindDocument({{ $item->id }})"></i>
                            @endif
                        </div>
                    </td>
                    <td width="25%">{!! Str::limit($item->content, 110) !!}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.document.export',id_enc($item->id,'doc')) }}"
                            type="button" class="mt-1 btn btn-sm btn-success" title="Cetak Template" target="_blank">
                            Cetak <i class="far fa-file-pdf"></i>
                        </a>
                    </td>
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
