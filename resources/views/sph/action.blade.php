<div class="dropdown">
    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
        style="--bs-btn-active-border-color:transparent;">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu">
        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $sph->id }}" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit <i
                    class="ml-4 fas fa-pen"></i></a></li>
        <li>
            <button class="dropdown-item text-danger fw-bold d-flex justify-content-between py-2" type="button"
                data-table-id="sph-table" data-url="{{ route('data-sph.delete', $sph->id) }}"
                data-name="{{ $sph->kode_sph }}" data-action="delete">
                Delete <i class="fas fa-trash"></i>
            </button>
        </li>
    </ul>
</div>