<div class="dropdown">
    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu">
        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
            data-id="{{ $dataclient->id }}" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit <i
                class="ml-4 fas fa-pen"></i>
            </a>
        </li>
        <li>
            <button class="dropdown-item text-danger fw-bold d-flex justify-content-between" type="button"
                data-table-id="dataclient-table" data-url="{{ route('data-client.delete', $dataclient->id) }}"
                data-name="{{ $dataclient->nama_client }}" data-action="delete">
                Delete <i class="fas fa-trash"></i>
            </button>
        </li>
    </ul>
</div>
