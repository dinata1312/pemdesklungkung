<?php

namespace App\Http\Livewire\Privilage;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;

class PermissionSelect extends Component
{
    use WithPagination, WithDataTable;

    public $model;
    public $name;

    public $modify = False;

    public $perPage = 1000;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    public $permission = [];
    public $selected = [];

    protected $listeners = [
        "deleteItem"      => "delete_item",
        "saved"           => "refreshTable",
        "setSelectedPerm" => "setSelected",
    ];

    public function selectObject()
    {
        $this->emit('selectPermission', $this->permission);
    }

    public function setSelected($value)
    {
        $this->permission = flip_selected_key( $value );
        $this->refreshTable();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function delete_item ($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function refreshTable()
    {
        $this->render();
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view('livewire.misc.permission-select', $data);
    }
}
