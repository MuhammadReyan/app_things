<div class="dropdown">
    <button class="btn btn-sm btn-outline-primary dropdown-toggle actions-dropdown-btn" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h actions-dropdown"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
        @if (check_access(array('A_DETAIL_KITCHEN_DISPLAY'), true))
            <a href="{{ $kitchen_display['detail_link'] }}" class="dropdown-item">{{ __("View") }}</a>
        @endif
        @if (check_access(array('A_EDIT_KITCHEN_DISPLAY'), true))
            <a href="edit_kitchen_display/{{ $kitchen_display['slack'] }}" class="dropdown-item">{{ __("Edit") }}</a>
        @endif
    </div>
</div>