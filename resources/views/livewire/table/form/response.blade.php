<div>
    <x-data-table :data="$data" :model="$respondent">
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'form_respondent.id'])
                </span></th>
                <th><span wire:click.prevent="sortBy('user_id')" role="button" href="#">
                    Nama
                    @include('components.sort-icon', ['field' => 'user_id'])
                </span></th>
                <th class="text-center"><span>
                    Aksi
                </span></th>
                <th class="text-center"><span wire:click.prevent="sortBy('form_respondent.created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'form_respondent.created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($respondent as $item)
                <tr x-data="window.__controller.dataTableController({{ $item->id }})">
                    <td>{{ itteration ($sortAsc, $loop, $perPage, $respondent) }}</td>
                    <td>
                        <b>{{ collection_match($item->formResponses,'form_question_id',1,'value') }}</b><br>
                        {{ $item->user->name }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.form.response',[$item->form->slug??id_enc($item->form_id,'form'),id_enc($item->id,'response')]) }}"
                            type="button" class="mt-1 btn btn-sm btn-primary" title="Tanggapan">
                            Tanggapan <i class="fas fa-external-link-alt"></i>
                        </a>
                        @if ($document)
                        <a href="{{ route('admin.document.export.response',id_enc($item->id,'response')) }}"
                            type="button" class="mt-1 btn btn-sm btn-success" title="Cetak Template" target="_blank">
                            Cetak <i class="far fa-file-pdf"></i>
                        </a>
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
