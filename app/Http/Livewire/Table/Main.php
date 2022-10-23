<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;

use App\Traits\PostTrait;
use App\Traits\FormTrait;
use App\Traits\NavigationTrait;
class Main extends Component
{
    use PostTrait,FormTrait,NavigationTrait;
    use WithPagination, WithDataTable;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = [
            "deleteItemAlt" => "delete_item_custom",
            "deleteItem" => "delete_item",
            "saved"      => "refreshTable"
        ];

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

    public function delete_item_custom ($value)
    {
        $id = $value[0];
        $model = $value[1];
        $data = $model::find($id);
        if (!$data) {
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data berhasil dihapus!"
        ]);
    }

    public function refreshTable()
    {
        $this->render();
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
