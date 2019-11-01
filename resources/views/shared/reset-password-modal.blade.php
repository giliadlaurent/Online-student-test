<div class="modal fade reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="reset-password-modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Are You Sure!</h4>
            </div>
            <div class="modal-body">
                <form method="GET">
                    <button id="modal-button-reset-password" class="btn btn-danger"
                        formaction="/{{ Auth::user()->getAdminPath() }}/">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>