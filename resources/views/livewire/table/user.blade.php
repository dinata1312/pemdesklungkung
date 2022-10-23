<div>
    <x-data-table :data="$data" :model="$users">
        <x-slot name="head">
            <tr>
                <th><span wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'num'])
                </span></th>
                <th><span wire:click.prevent="sortBy('name')" role="button" href="#">
                    Nama
                    @include('components.sort-icon', ['field' => 'name'])
                </span></th>
                <th><span wire:click.prevent="sortBy('email')" role="button" href="#">
                    Email/ Username
                    @include('components.sort-icon', ['field' => 'email'])
                </span></th>
                <th><span>
                    Peran
                </span></th>
                <th class="text-center"><span wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </span></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
                <tr x-data="window.__controller.dataTableController({{ $user->id }})">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}
                        <div class="whitespace-no-wrap row-action--icon">
                            @if (perm('admin.user.edit'))
                            <a role="button" href="{{ route('admin.user.edit',id_enc($user->id,'user')) }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                            @endif
                            @if (perm('admin.user.delete'))
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    <td>
                        {{ $user->email }}<br>
                        <small title="Username">{{ $user->username }}</small>
                    </td>
                    <td width="10%">
                        {!! collapse_more($user->getRoleNames()->toArray(), $user->id,'roles',3) !!}
                    </td>
                    <td class="text-center">{!! date_record($user) !!}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
