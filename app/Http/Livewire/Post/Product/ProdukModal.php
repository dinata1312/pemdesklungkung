<?php

namespace App\Http\Livewire\Post\Product;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Repositories\PostRepository;
use App\Repositories\PostTagRepository;
use App\Repositories\PostImageRepository;
use App\Models\Tag;

class ProdukModal extends Component
{
    protected $post_type = "product";
    protected $listeners = [
        'showCreateModal' => 'showCreateModal',
        'showUpdateModal' => 'showUpdateModal',
        'slugex'          => 'setSlug',
        'selectFile'      => 'setImage'
        ];

    public $model;
    public $name;

    public $modelId;
    public $button;
    public $action;
    public $modalFormVisible = false;

    // Model Attribute
    public $title;
    public $slug;
    public $content;
    public $setting;
    public $publish = 0;
    public $meta; #not used yet
    public $images=[];
    public $postTags=[];

    public $postOptionTags;

    /**
     * Catch Signal from Slugex
     *
     * @param  mixed $value
     * @return void
     */
    public function setSlug($value)
    {
        if(!is_null($value))
            $this->slug = $value;
    }

    public function setImage($value)
    {
        if(!is_null($value))
            $this->images = $value;
    }

    /**
     * Properties that Store Form Inputs
     *
     * @return Array
     */
    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [

        ]: [

        ];

        return array_merge([
            'title' => $this->title,
            'slug' => text_to_slug($this->slug),
            'content' => $this->content,
            'postTags' => $this->postTags,
            'publish' => $this->publish,
        ],$attributes);
    }

    public function showCreateModal()
    {
        $force = ($this->action == 'update') ? $this->loadModalContent(True) : false;
        $this->action = "create";
        $this->resetValidation();
        $this->modelId = null;
        $this->modalFormVisible = true;
    }

    public function showUpdateModal($id)
    {
        $this->action = "update";
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModalContent();
    }

    /**
     * Reload Form Input
     *
     * @param  mixed $refresh
     * @return void
     */
    public function loadModalContent($refresh = False)
    {
        $this->action = ($refresh)? "create" : $this->action;
        $this->button = create_button($this->action, "Produk");
        switch ($this->action){
            case "create":
                $this->reset(['title','slug','content','postTags','publish','images']);
                $this->emit('clearSelected');
                $this->emit('setSelectedBlob',[]);
                break;
            case "update":
                $postRepository = new PostRepository;
                $postTagRepository = new PostTagRepository;
                $postImageRepository = new PostImageRepository;
                $post = $postRepository->find($this->modelId);
                $postTag = $postTagRepository->getTagByPostId($this->modelId);
                $images = $postImageRepository->getImageByPostId($this->modelId);
                $this->title    = $post->title;
                $this->slug     = $post->slug;
                $this->content  = $post->content;
                $this->publish  = $post->publish;
                $this->postTags = eloquent_to_selected($postTag);
                $this->images   = flip_selected_key( eloquent_to_selected($images, 'image_id') );
                $this->emit('clearSelected');
                $this->emit('setText', ['content', $this->content]);
                $this->emit('setSelectedOption', [$postTag, 'tag_id']);
                $this->emit('setSelectedBlob',$this->images);
                break;
        }
    }

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title'   => 'required',
            'slug'    => ['required', Rule::unique('posts', 'slug')->ignore($this->modelId),'alpha_dash'],
            'content' => 'required',
            'publish' => 'nullable'
        ];
    }

    public function create()
    {
        $postRepository = new PostRepository;
        $postTagRepository = new PostTagRepository;
        $postImageRepository = new PostImageRepository;
        $this->validate();
        $post = $postRepository->createByType($this->post_type, $this->modelData());
        $this->modalFormVisible = false;
        $postTagRepository->massCreate($this->postTags, $post->id);
        if( count($this->images)>0 ){
            $postImageRepository->massCreate($this->images, $post->id);
        }

        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $postRepository = new PostRepository;
        $postTagRepository = new PostTagRepository;
        $postImageRepository = new PostImageRepository;
        $this->validate();
        $postRepository->find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $postTagRepository->destroyTagByPostId($this->modelId);
        $postTagRepository->massCreate($this->postTags, $this->modelId);
        if( count($this->images)>0 ){
            $postImageRepository->destroyImageByPostId($this->modelId);
            $postImageRepository->massCreate($this->images,$this->modelId);
        }

        $this->emit('saved');
    }

    public function mount()
    {
        $this->title;
        $this->slug;
        $this->content;
        $this->postOptionTags = eloquent_to_options(Tag::get(), 'id', 'label');
        $this->button = create_button($this->action??'create', "Produk");
    }

    public function render()
    {
        return view('livewire.modal.post.produk-modal',[]);
    }

}
