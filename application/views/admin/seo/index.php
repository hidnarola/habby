<script type="text/javascript" src="<?php echo DEFAULT_ADMIN_JS_PATH . "plugins/tables/datatables/datatables.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo DEFAULT_ADMIN_JS_PATH . "plugins/forms/selects/select2.min.js"; ?>"></script>
<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - SEO Pages</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><i class="icon-users4 position-left"></i> SEO Pages</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0 flashmsg" style='padding-bottom:0px;'>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0 flashmsg" style='padding-bottom:0px;'>
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    if (!empty(validation_errors())) {
        ?>
        <div class="content pt0 flashmsg" style='padding-bottom:0px;'>
            <div class = "alert alert-danger">
                <a class="close" data-dismiss="alert">X</a>
                <strong><?php echo validation_errors(); ?></strong>       
            </div>
        </div>
        <?php
    }
}
?>
<!-- Content area -->
<div class="content">
    <!-- /content area -->
    <div class="content">
        <div class="panel panel-flat">
            <!--            <div class="panel-heading text-right">
                            <a href="<?php echo site_url('admin/league/add'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-add"></i></b> Add new Group</a>
                        </div>-->
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Page Name</th>
                        <th>Meta Title</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="metaModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Meta Detail</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Page Name</td>
                            <td id='page_name'></td>
                        </tr>
                        <tr>
                            <td>Meta Title</td>
                            <td id='meta_title'></td>
                        </tr>
                        <tr>
                            <td>Meta Keyword</td>
                            <td id='meta_keyword'></td>
                        </tr>
                        <tr>
                            <td>Meta Description</td>
                            <td id='meta_description'></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.datatable-basic').dataTable({
            processing: true,
            serverSide: true,
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            order: [[0, "asc"]],
            ajax: 'seo/list_seo',
            columns: [
                {
                    data: "test_id",
                    visible: true,
                    searchable: false,
                    sortable: false,
                },
                {
                    data: "page",
                    visible: true
                },
                {
                    data: "meta_title",
                    visible: true
                },
                {
                    visible: true,
                    searchable: false,
                    sortable: false,
                    width: 200,
                    render: function (data, type, full, meta) {
                        var action = '';

                        action += '<a href="javascript:;" class="meta_view btn border-info text-info-600 btn-flat btn-icon btn-rounded" title="View Details" data-id="' + full.id + '" data-page="' + full.page + '" data-meta_title="' + full.meta_title + '" data-meta_keyword="' + full.meta_keyword + '" data-meta_description="' + full.meta_description + '"><i class="icon-eye4"></i></a>'
                        action += '&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/seo/edit/' + full.id + '" class="btn border-danger text-danger-600 btn-flat btn-icon btn-rounded" title="Edit"><i class="icon-pencil3"></i></a>'

                        return action;
                    }
                }
            ]
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
        
        $(document).on('click','.meta_view',function(){
            $('#page_name').html($(this).data('page'));
            $('#meta_title').html($(this).data('meta_title'));
            $('#meta_keyword').html($(this).data('meta_keyword'));
            $('#meta_description').html($(this).data('meta_description'));
            $('#metaModal').modal('show');
        });
    });
</script>