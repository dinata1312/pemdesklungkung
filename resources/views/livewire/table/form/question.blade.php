<div>
    <x-data-table :data="$data" :model="$questions">
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </span></th>
                <th><span wire:click.prevent="sortBy('label')" role="button" href="#">
                    Label
                    @include('components.sort-icon', ['field' => 'label'])
                </span></th>
                <th><span wire:click.prevent="sortBy('type')" role="button" href="#">
                    Tipe
                    @include('components.sort-icon', ['field' => 'type'])
                </span></th>
                <th><span wire:click.prevent="sortBy('marker')" role="button" href="#">
                    Penanda
                    @include('components.sort-icon', ['field' => 'marker'])
                </span></th>
                <th><span wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($questions as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $questions) }}</td>
                    <td>
                        <b>{{ Str::limit($item->label, 110) }}</b><br>
                        @php
                            $options = null;
                            $meta = json_decode($item->meta,true);
                            if(!is_null($meta)){
                                if ( array_key_exists('option', $meta) ) {
                                    $options = "Opsi: ".implode(", ", (array) $meta['option']);
                                }
                            }
                        @endphp
                        {{ $options ?? '' }}
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.form.*'))
                            <a role="button" wire:click="$emit('showUpdateModal',{{ $item->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.form.*'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td>{{ $item->type }}</td>
                    <td>%{{ $item->marker }}%</td>
                    <td>{!! date_record($item) !!}</td>
                </tr>
                @empty
                <tr><td colspan="100" class="text-center">Tidak ada hasil</td></tr>
            @endforelse
        </x-slot>
    </x-data-table>
</div>
