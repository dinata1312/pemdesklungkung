<div>
    <x-data-table :data="$data" :model="$forms">
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </span></th>
                <th><span wire:click.prevent="sortBy('name')" role="button" href="#">
                    Nama Formulir
                    @include('components.sort-icon', ['field' => 'name'])
                </span></th>
                <th><span wire:click.prevent="sortBy('desc')" role="button" href="#">
                    Deskripsi
                    @include('components.sort-icon', ['field' => 'desc'])
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
            @forelse ($forms as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $forms) }}</td>
                    <td>
                        <b>{{ Str::limit($item->name, 110) }}</b><br>
                        @if($item->open_time)<span class='badge badge-light text-dark' title="Tanggal Dibuka"><i class="mr-1 fa fa-calendar-check text-success"></i>{{ $item->open_time }}</span>@endif
                        @if($item->close_time)<span class='badge badge-light text-dark' title="Tanggal Ditutup"><i class="mr-1 fa fa-calendar-times"></i>{{ $item->close_time }}</span>@endif
                        <div class="whitespace-no-wrap row-action--icon">
                            <a role="button" href="{{ route('form.public',$item->slug??id_enc($item->id,'form-public')) }}"
                                target="_blank" class="mr-3">
                                <i class="text-info fas fa-16px fa-external-link-alt"></i></a>
                            @if (perm('admin.form.*'))
                            <a role="button" wire:click="$emit('showUpdateModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.form.*'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-danger fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td width="25%">{!! Str::limit($item->desc, 110) !!}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.form.respondent',$item->slug??id_enc($item->id,'form')) }}"
                            type="button" class="mt-1 btn btn-sm btn-primary" title="Responden">
                            <i class="fas fa-user-edit"></i> <span class="badge badge-light">{{ $item->formRespondents->count() }}</span>
                        </a>
                        <a href="{{ route('admin.form.edit',$item->slug??id_enc($item->id,'form')) }}"
                            type="button" class="mt-1 btn btn-sm btn-warning" title="Isian">
                            <i class="fas fa-list-ol"></i> <span class="badge badge-light">{{ $item->formQuestions->count() }}</span>
                        </a><br>
                        <a type="button" class="mt-1 btn btn-sm btn-info" title="Pratinjau"
                            wire:click="$emit('showPreviewModal',{{ $item->id }})">
                            <i class="fas fa-search"></i>
                        </a>
                        <a href="{{ route('admin.form.export',$item->slug??id_enc($item->id,'form')) }}"
                            type="button" class="mt-1 btn btn-sm btn-success" title="Ekspor">
                            <i class="fas fa-file-export"></i>
                        </a>
                        <a type="button" class="mt-1 btn btn-sm btn-dark" title="Sambungan"
                            wire:click="$emit('showConnectModal',{{ $item->id }})">
                            <i class="fas fa-network-wired"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        {!! $item->closed==1 ? "<span class='badge badge-secondary text-dark'>Ditutup</span>" : "<span class='badge badge-success'>Dibuka</span>" !!}<br>
                        {!! date_record($item) !!}
                    </td>
                </tr>
                @empty
                <tr><td colspan="100" class="text-center">Tidak ada hasil</td></tr>
            @endforelse
        </x-slot>
    </x-data-table>
</div>
