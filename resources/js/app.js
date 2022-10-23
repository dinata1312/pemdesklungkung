require('./bootstrap');

function dataTableController (id) {
    return {
        id,
        deleteItem() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteItem', this.id);
                }
            })
        }
    }
}

function dataTableControllerAlt (id, model) {
    return {
        id,
        deleteItem() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteItemAlt', [this.id, model]);
                }
            })
        }
    }
}

function dataTableMainController () {
    return {
        setCallback() {
            Livewire.on('deleteResult', (result) => {
                if (result.status) {
                    Swal.fire(
                        'Dihapus!',
                        result.message,
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Opps, Terdapat kesalahan!',
                        result.message,
                        'error'
                    );
                }
            });
        }
    }
}

window.__controller = {
    dataTableController,
    dataTableControllerAlt,
    dataTableMainController
}
