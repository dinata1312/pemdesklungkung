<?php

namespace App\Traits;

use App\Models\Post;
use App\Models\Blob;
use App\Models\Navigation;

trait WithDataTable {

    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.user.new'),
                            'create_new_text' => 'Buat User',
                            // 'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'pengumuman':
                $postType = 'notice';
                $announcements = Post::search($this->search, $postType)->whereIn('publish', $this->publish)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.post.pengumuman',
                    "announcements" => $announcements,
                    "data" => array_to_object([
                        'href' => [
                            'create_btn' => 'Buat Pengumuman',
                        ]
                    ])
                ];
                break;

            case 'halaman':
                $postType = 'page';
                $page = Post::search($this->search, $postType)->whereIn('publish', $this->publish)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.post.halaman',
                    "announcements" => $page,
                    "data" => array_to_object([
                        'href' => [
                            'create_btn' => 'Buat Halaman',
                        ]
                    ])
                ];
                break;

            case 'banner':
                $postType = 'hero';
                $hero = Post::search($this->search, $postType)->whereIn('publish', $this->publish)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.post.banner',
                    "announcements" => $hero,
                    "data" => array_to_object([
                        'href' => [
                            'create_btn' => 'Buat Baner',
                        ]
                    ])
                ];
                break;

            case 'produk':
                    $postType = 'product';
                    $product = Post::search($this->search, $postType)->whereIn('publish', $this->publish)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage);

                    return [
                        "view" => 'livewire.table.post.produk',
                        "announcements" => $product,
                        "data" => array_to_object([
                            'href' => [
                                'create_btn' => 'Buat Produk',
                            ]
                        ])
                    ];
                    break;

            case 'term':
                $terms = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.post.term',
                    "terms" => $terms,
                    "data" => array_to_object([
                        'href' => [
                            'create_btn' => 'Buat Topik',
                        ]
                    ])
                ];
                break;

            case 'tag':
                $tags = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.post.tag',
                    "tags" => $tags,
                    "data" => array_to_object([
                        'href' => [
                            'create_btn' => 'Buat Kategori',
                        ]
                    ])
                ];
                break;


            case 'file-upload':
                    $blob = Blob::search($this->search, $this->directory)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage);
                    return [
                        "files" => $blob,
                    ];
                    break;
                break;

            case 'section':
            case 'setting':
                    $options = $this->model::search($this->search)
                        ->orderBy('type', 'asc')
                        ->paginate($this->perPage);
                    return [
                        "options" => $options,
                    ];
                    break;
                break;

            case 'document':
                    $documents = $this->model::search($this->search)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage);
                        return [
                            "view" => 'livewire.table.form.document',
                            "documents" => $documents,
                            "data" => array_to_object([
                                'href' => [
                                    'create_new' => route('admin.document.new'),
                                    'create_new_text' => 'Buat Document',
                                ]
                            ])
                        ];
                break;

            case 'navigation':
                    $this->sortField = $this->sortField == 'id' ? 'sequence' : $this->sortField;
                    $navigations = $this->model::search($this->search)
                        ->orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc')
                        ->paginate($this->perPage);
                    return [
                        "view" => 'livewire.table.navigation',
                        "navigations" => $navigations,
                        "data" => array_to_object([
                            'href' => [
                                'create_new_text' => 'Buat Item Navigasi',
                                // 'export' => '#',
                            ]
                        ])
                    ];
                    break;

            case 'role':
                $roles = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.privilage.role',
                    "roles" => $roles,
                    "data" => array_to_object([
                        'href' => [
                            'create_btn' => 'Buat Peran',
                        ]
                    ])
                ];
                break;

            case 'permission':
                $permissions = $this->model::search($this->search)
                    ->orderBy('name', 'asc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.privilage.permission',
                    "permissions" => $permissions,
                    "data" => array_to_object([
                        'href' => [
                            'create_new_text' => 'Buat Wewenang',
                        ]
                    ])
                ];
                break;

            case 'form':
                $forms = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.form.form',
                    "forms" => $forms,
                    "data" => array_to_object([
                        'href' => [
                            'create_new_text' => 'Buat Formulir',
                        ]
                    ])
                ];
                break;
            case 'response':
                if($this->sortField === 'id'){
                    $this->sortField = 'form_respondent.id';
                }
                    $respondent = $this->model::search($this->search, $this->formId)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate($this->perPage);
                    return [
                        "view" => 'livewire.table.form.response',
                        "respondent" => $respondent,
                        "document" => $this->document ?? null,
                        "data" => array_to_object([
                            'href' => [
                                'create_new'      => route('form.public',id_enc($this->formId,'form-public')),
                                'create_new_text' => 'Tanggapan Baru',
                                'export'          => route('admin.form.export',id_enc($this->formId,'form')),
                                'export_text'     => 'Ekspor Tanggapan'
                            ]
                        ])
                    ];
                    break;
            case 'question':
                $questions = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.form.question',
                    "questions" => $questions,
                    "data" => array_to_object([
                        'href' => [
                            'create_new_text' => 'Buat Pertanyaan',
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }
}
