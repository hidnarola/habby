<!--<script type="text/javascript" src="<?php // echo DEFAULT_ADMIN_JS_PATH . "pages/datatables_data_sources.js";                                               ?>"></script>-->
<script type="text/javascript" src="<?php echo DEFAULT_ADMIN_JS_PATH . "plugins/tables/datatables/datatables.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo DEFAULT_ADMIN_JS_PATH . "plugins/forms/selects/select2.min.js"; ?>"></script>
<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Admin</span> - Topichat Group List</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() . "admin/dashboard" ?>"><i class="icon-home2 position-left"></i> Admin</a></li>
            <li><i class="icon-users4 position-left"></i> Topichat Groups</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0 flashmsg">
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
        <div class="content pt0 flashmsg">
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
            <div class="panel-heading text-right">
                <a href="<?php echo site_url('admin/topichat/add'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-add"></i></b> Add new Group</a>
            </div>
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Topic Name</th>
                        <th>No. of joined</th>
                        <th>Person Limit</th>
                        <th>Username</th>
                        <th>Created Date</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
            </table>
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
                searchPlaceholder: "Search by topic name or username",
                lengthMenu: '<span>Show:</span> _MENU_',
//                width:250px,
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            order: [[0, "asc"]],
            ajax: 'topichat/list_topichat',
            columns: [
                {
                    data: "test_id",
                    visible: true,
                    searchable: false,
                    sortable: false,
                },
                {
                    data: "topic_name",
                    visible: true
                },
                {
                    data: "total_joined",
                    visible: true,
                    searchable: false
                },
                {
                    data: "person_limit",
                    visible: true,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        if (full.person_limit == '-1') {
                            return "No Limit";
                        } else {
                            return full.person_limit;
                        }
                    }
                },
                {
                    data: "user_name",
                    visible: true
                },
                {
                    data: "created_date",
                    visible: true,
                    searchable: false,
                },
                {
                    data: "is_deleted",
                    visible: true,
                    searchable: false,
                    sortable: false,
                    width: 200,
                    render: function (data, type, full, meta) {
                        var action = '';
                        if (full.is_blocked == '0') {
                            action += '<a href="<?php echo base_url(); ?>admin/topichat/view/' + full.id + '" class="btn border-info text-info-600 btn-flat btn-icon btn-rounded btn-sm" title="View Details"><i class="icon-eye4"></i></a>';
                            action += '&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/topichat/edit/' + full.id + '" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm" title="Edit"><i class="icon-pencil3"></i></a>';
                            action += '&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/topichat/block/' + full.id + '" class="btn border-orange text-orange-600 btn-flat btn-icon btn-rounded"  title="Block"><i class="icon-lock2"></i></a>'
                            action += '&nbsp;&nbsp;<a href="javascript:void(0)" class="btn border-danger text-danger-600 btn-flat btn-icon btn-rounded delete-group" onclick="delete_topichat(' + full.id + ')" title="Delete"><i class="icon-cross2"></i></a>'
                        } else {
                            action += '<a href="<?php echo base_url(); ?>admin/topichat/view/' + full.id + '" class="btn border-info text-info-600 btn-flat btn-icon btn-rounded"  title="View Details"><i class="icon-eye4"></i></a>'
                            action += '&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/topichat/activate/' + full.id + '" class="btn border-green text-green-600 btn-flat btn-icon btn-rounded"  title="Unblock"><i class="icon-unlocked2"></i></a>'
                            action += '&nbsp;&nbsp;<a href="javascript:void(0)" class="btn border-danger text-danger-600 btn-flat btn-icon btn-rounded delete-group" onclick="delete_topichat(' + full.id + ')" title="Delete"><i class="icon-cross2"></i></a>'
                        }
                        return action;
                    }
                }
            ]
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });

    });
    function delete_topichat(id) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Topichat Group!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location.href = "<?php echo base_url(); ?>admin/topichat/delete/" + id;
//                        swal("Deleted!", "Your Topichat Group has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your Topichat Group is safe :)", "error");
                    }
                });
    }
</script>