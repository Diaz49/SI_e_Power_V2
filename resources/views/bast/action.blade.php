<div class="dropdown">
    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
        style="--bs-btn-active-border-color:transparent;">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ route('bast-print', $bast->id) }}"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2" data-id="{{ $bast->id }}"
                type="button">Cetak Bast <i class="ml-4 fas fa-print"></i></a></li>
        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                id="btnEdit" data-id="{{ $bast->id }}" data-kode-invoice="{{ $bast->invoice->kd_invoice }}"
                type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit <i class="ml-4 fas fa-pen"></i>
            </a>
        </li>
        <li>
            <button class="dropdown-item text-danger fw-bold d-flex justify-content-between" type="button"
                data-table-id="bast-table" data-url="{{ route('bast.destroy', $bast->id) }}"
                data-name="{{ $bast->nama_bank }}" data-action="delete">
                Delete <i class="fas fa-trash"></i>
            </button>
        </li>
    </ul>
</div>
