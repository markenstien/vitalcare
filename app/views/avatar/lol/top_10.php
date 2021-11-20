<?php
build('content')?>
    <?php grab('partial/navigation_main')?>
    <hr>
    <div class="hd-header-wrapper" 
        style="background-image: url(https://pm1.narvii.com/6613/c7fc27bc88e8a4836cff2e51ce8a0b3b9bf8879c_hq.jpg); 
        padding:50px;
        height:25vh">
        <div class="row">                                
            <div class="col-md-12 text-center">
                <h4 class=""><?php echo $gameName?></h4>
                <p class=""><?php echo $gameDesc?></p>
            </div>
        </div>
    </div>

    <div style="margin-top: 30px;"></div>
    <div class="layout-px-spacing">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-4 table-hover" id="zero-config">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Pick Rate</th>
                            <th>Win Rate</th>
                            <th>Lose Rate</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($avatars as $key => $row) :?>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame mr-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle" 
                                            src="<?php echo $champImageLink.$row->image->full?>">
                                        </div>
                                        <p class="align-self-center mb-0"><?php echo $row->name?></p>
                                    </div>
                                </td>
                                <td><?php echo wWrapSpan( $row->tags) ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="<?php echo _route('avatar:show' , null, [
                                        'module' => GAMES_LOL,
                                        'avatar_id'     => $row->id
                                    ]) ?>" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
            
            <hr>
            <div>
                <?php
                    Form::open([
                        'method' => 'get',
                        'action' => _route('balancer:index')
                    ]);

                    Form::hidden('module' , GAMES_LOL);
                ?>
                <div class="form-group">
                    <?php Form::submit('balance_hero' , 'Balance Hero')?>
                </div>
                <?php Form::close()?>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts')?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo _path_tmp('plugins/table/datatable/datatables.js')?>"></script>
<script>
    $('#zero-config').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7 
    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php endbuild()?>
<?php loadTo('tmp/base')?>