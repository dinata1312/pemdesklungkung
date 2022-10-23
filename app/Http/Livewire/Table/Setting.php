<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;
use App\Repositories\SettingRepository;
use App\Repositories\SectionRepository;
use App\Repositories\BlobRepository;
use Livewire\WithFileUploads;

class Setting extends Component
{
    use WithPagination, WithDataTable, WithFileUploads;

    public $model;
    public $name;
    public $action = "update";

    public $button;
    public $title;
    public $option = [];
    public $meta;

    public $perPage = 99;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    public function refreshTable()
    {
        $this->render();
    }

    public function mount()
    {
        $data = $this->get_pagination_data();
        foreach ($data['options'] as $opt) {
            if(value_of_key($opt, 'title')){
                //For Sections
                $this->option[$opt->key] = $opt->content == '0'? null : $opt->content;
                $this->title[$opt->key] = $opt->title == '0'? 'n/a' : $opt->title;
                $this->meta[$opt->key] = $opt->meta == '0'? null : $opt->meta;
            }else{
                //For General Settings
                $this->option[$opt->key] = $opt->value == '0'? null : $opt->value;
            }
        }
        $this->button = create_button('update', "Pengaturan");
    }

    public function update()
    {
        $blobRepository    = new BlobRepository;
        $settingRepository = new SettingRepository;
        $sectionRepository = new SectionRepository;
        if(!is_null($this->title)){
            //For Sections
            //Upload Blob
            foreach($this->meta as $key => $meta){
                if(!is_string($meta) and !is_null($meta)){
                    $this->meta[$key] = $blobRepository->uploadFile($meta, "gambar", 1);
                }
            }
            $sectionRepository->updateAllByKey($this->option, $this->title, $this->meta);
        }else{
            //For General Settings
            $settingRepository->updateAllByKey($this->option);

        }
        $this->emit('saved');
        // return redirect(route('admin.setting.general'));
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        return view('livewire.misc.setting', $data);
    }
}
