$(".in-title").keyup(function() {
    var nama = $(this).val()
    var slug = $('.in-link').val(nama.toString().toLowerCase().normalize('NFD').trim().replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-'));
        Livewire.emit('slugex', slug.val());
});
