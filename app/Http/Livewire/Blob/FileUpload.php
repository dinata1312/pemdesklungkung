<?php

namespace App\Http\Livewire\Blob;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;
use App\Models\Blob;
use App\Repositories\BlobRepository;

class FileUpload extends Component
{
    use WithPagination, WithDataTable;

    public $model = Blob::class;
    public $name = "file-upload";
    public $size;
    public $attribute;

    public $directory = "file";
    public $directoryOption = ['file','gambar','attachment'];
    public $limit = -1;
    public $selected;

    public $active;
    public $perPage = 6;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = [
        "successUpload"   => "refreshTable",
        "setSelectedBlob" => "fetchBlobData",
        "setSelected"     => "refreshTable",
        "deleteItemAlt"   => "delete_item",
    ];

    public function __construct($size, $attribute = '', $selected = [])
    {
        $this->size = $size;
        $this->attribute = $attribute;
        $this->selected = $selected;
    }

    public function fetchBlobData($selected)
    {
        $this->selected = $selected;
        $this->render();
    }

    public function selectObject()
    {
        if($this->limit > 0){
            $arr = [];
            if(count($this->selected) > $this->limit) {
                foreach ($this->selected as $key => $item) {
                    if( count($arr) < $this->limit && $item != false ){
                        $arr[$key]=$item;
                    }
                }
                $this->selected = $arr;
                $this->emit('setSelectedBlob',$this->selected);
                $this->render();
            }else{
                $this->emit('selectFile', $this->selected);
            }
        }else{
            $this->emit('selectFile', $this->selected);
        }
    }

    public function changeDir($value)
    {
        $this->directory = strtolower($value);
    }

    public function isSelected($object = '')
    {
        return in_array($object, $this->selected);
    }

    public function delete_item ($value)
    {
        $id = $value[0];
        $blobRepository = new BlobRepository;
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $blobRepository->deleteFile($data);
        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function refreshTable()
    {
        $this->active = "document";
        $this->render();
    }

    public function mount()
    {
        $this->selected;
        $this->directory;
        $this->directoryOption;
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        return view('livewire.misc.file-upload', $data);
    }
}
