<div id="signin" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class="fa fa-user"></i> Sign into 1st RRF</h3>
            </div>
            <div class="modal-body">
                <div class="text-center">

                    <a href="{{\SteamLogin::url(url('auth/validate'))}}">
                        <img src="/img/steam_login.png">
                    </a>
                </div>
            </div>
            <div class="modal-footer text-left">
                1st Rapid Response Force uses <a href="https://steamcommunity.com/dev">Steam Open Authentication</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
